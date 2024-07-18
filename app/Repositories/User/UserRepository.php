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

    public function getWithRole(array $select = [])
    {
        return QueryBuilder::builder($this->model)
            ->select($select)
            ->where([['user_roles.role_id', '!=', 'DEV']])
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->orderBy(['users.id' => 'asc'])
            ->groupBy('users.id')
            ->build()
            ->get();
    }
}
