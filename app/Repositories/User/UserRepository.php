<?php

namespace App\Repositories\User;

use App\Helper\QueryBuilder;
use App\Models\User;
use App\Repositories\Repository;
use App\Traits\Repositories\CrudRepository;
use App\Traits\Repositories\PagingRepository;

class UserRepository extends Repository
{
    use CrudRepository, PagingRepository;

    public function __construct()
    {
        parent::__construct(new User());
    }

    public function findByEmail(string $email): User|null
    {
        return QueryBuilder::builder($this->model)
            ->where(['email' => $email])
            ->build()
            ->first();
    }

    public function isEmailExists(string $email): bool
    {
        return QueryBuilder::builder($this->model)
            ->where(['email' => $email])
            ->build()
            ->exists();
    }

    public function changeRole(string $userId, string $roleId)
    {
        return QueryBuilder::builder($this->model)
            ->where(['id' => $userId])
            ->build()
            ->update(['role_id' => $roleId]);
    }

    public function findAllWithRole(array $select = [])
    {
        return QueryBuilder::builder($this->model)
            ->select($select)
            ->where([['users.role_id', '!=', 'DEV']])
            ->orderBy(['users.id' => 'asc'])
            ->build()
            ->get();
    }
}
