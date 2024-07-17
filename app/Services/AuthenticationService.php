<?php

namespace App\Services;

use App\Models\Keycloak\KeycloakUser;
use App\Models\User;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRoleRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticationService
{
    public function __construct(private readonly UserRepository     $userRepository,
                                private readonly UserRoleRepository $userRoleRepository,
                                private readonly RoleRepository     $roleRepository)
    {
    }

    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {
            $email = $data['email'];
            $role = strtoupper($data['role_id'] ?? 'USER');
            // if password is not provided (user login via keycloak)
            // then set user password as null
            $password = $data['password'] ?? null;

            $isEmailAlreadyExists = $this->userRepository->isEmailExists($email);
            if ($isEmailAlreadyExists) {
                throw ValidationException::withMessages([
                    'email' => 'Email yang anda masukkan sudah terdaftar'
                ]);
            }

            $isRoleExists = $this->roleRepository->exists($role);
            if (!$isRoleExists) {
                throw ValidationException::withMessages([
                    'role_id' => 'Role yang anda masukkan tidak valid'
                ]);
            }

            $user = $this->userRepository->create([
                'id' => $data['id'] ?? strtolower(Str::ulid()),
                'name' => $data['name'],
                'email' => $email,
                'password' => $password,
            ]);

            $this->userRoleRepository->create($user->id, $role);

            Log::info('REGISTER', $user->toArray());
            return $user;
        });
    }

    public function logInViaDatabase(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email yang anda masukkan tidak ditemukan',
            ]);
        }

        if ($user->isRegisteredViaKeycloak()) {
            throw ValidationException::withMessages([
                'email' => 'Email anda terdaftar menggunakan Single Sign On (SSO), silahkan masuk menggunakan SSO',
            ]);
        }

        if (!$user->isValidPassword($password)) {
            throw ValidationException::withMessages([
                'password' => 'Password yang anda masukkan salah',
            ]);
        }

        Log::info('SIGN_IN', $user->toArray());
        return $user;
    }

    public function logInViaKeycloak(KeycloakUser $keycloakUser)
    {
        return DB::transaction(function () use ($keycloakUser) {
            $user = $this->userRepository->findByEmail($keycloakUser->email);
            if (!$user) {
                $user = $this->register([
                    'name' => $keycloakUser->fullName,
                    'email' => $keycloakUser->email,
                ]);

                // uncomment line below if you want to save keycloak user to database
                // $this->userKeycloakRepository->createFromEntity($keycloakUser);
            }

            Log::info('SIGN_IN_KEYCLOAK', $keycloakUser->toArray());
            return $user;
        });
    }

    public function sendResetPasswordLink(string $email)
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages(['email' => __($status)]);
        }

        Log::info('FORGOT_PASSWORD', ['email' => $email]);
        return $status;
    }

    public function resetPassword(string $email, string $password, string $token)
    {
        $payload = [
            'email' => $email,
            'password' => $password,
            'token' => $token
        ];

        $status = Password::reset($payload, function (User $user, string $password) {
            $user->forceFill(['password' => Hash::make($password)])
                ->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages(['email' => __($status)]);
        }

        Log::info('RESET_PASSWORD', ['email' => $email]);
        return $status;
    }
}
