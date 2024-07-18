<?php

namespace App\Services;

use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRoleRepository;
use Illuminate\Validation\ValidationException;

class UserRoleService
{
    public function __construct(private readonly RoleRepository     $roleRepository,
                                private readonly UserRepository     $userRepository,
                                private readonly UserRoleRepository $userRoleRepository)
    {
    }

    public function getUsersWithRole()
    {
        return $this->userRepository->getWithRole(select: ['name', 'user_id', 'role_id']);
    }

    public function changeRole(string $userId, string $roleId)
    {
        $isUserExists = $this->userRepository->exists($userId);
        if (!$isUserExists) {
            throw ValidationException::withMessages([
                'user_id' => 'ID User tidak ditemukan',
            ]);
        }

        $isRoleExists = $this->roleRepository->exists($roleId);
        if (!$isRoleExists) {
            throw ValidationException::withMessages([
                'role_id' => 'ID Role tidak ditemukan',
            ]);
        }

        return $this->userRoleRepository->update($userId, $roleId);
    }
}
