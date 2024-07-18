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

    public function findAllAvailableRole(array $select): array
    {
        return $this->roleRepository->findAll(
            select: $select,
            where: [['id', '!=', 'DEV']],
            orderBy: ['id', 'asc']);
    }

    public function findAllUserWithRole(array $select)
    {
        return $this->userRepository->findAllWithRole(select: $select);
    }

    public function updateRole(string $userId, string $roleId)
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
