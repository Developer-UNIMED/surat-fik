<?php

namespace App\Repositories\User;

use App\Helper\QueryBuilder;
use App\Models\Role;
use App\Repositories\Repository;
use App\Traits\Repositories\CrudRepository;

class RoleRepository extends Repository
{
    use CrudRepository;

    public function __construct()
    {
        parent::__construct(new Role());
    }

    public function findAllPenerimaSurat(array $select = ['*'])
    {
        return QueryBuilder::builder($this->model)
            ->select($select)
            ->whereNotIn('id', ['USER', 'ADMIN_PJKR', 'ADMIN_PKO', 'ADMIN_IKOR', 'DEV'])
            ->orderBy(['id' => 'ASC'])
            ->build()
            ->get();
    }
}
