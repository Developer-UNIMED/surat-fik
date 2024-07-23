<?php

namespace Services;

use App\Models\Role;
use App\Models\User;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\UserRoleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserRoleService $service;
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(UserRoleService::class);
        $this->userRepository = app(UserRepository::class);
        $this->roleRepository = app(RoleRepository::class);

        $roles = [
            ['id' => 'USER', 'name' => 'USER'],
            ['id' => 'ADMIN', 'name' => 'ADMIN'],
            ['id' => 'DEV', 'name' => 'DEVELOPER'],
        ];
        Role::insert($roles);
        User::factory()->count(10)->create(['role_id' => $roles[array_rand($roles)]['id']]);
    }

    public function testGetWithRole(): void
    {
        $result = $this->userRepository->findAllWithRole(select: ['id', 'name', 'role_id']);
        self::assertNotEmpty($result);
    }


}
