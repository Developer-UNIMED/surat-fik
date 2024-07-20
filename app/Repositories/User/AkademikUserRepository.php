<?php

namespace App\Repositories\User;

use App\Helper\QueryBuilder;
use App\Models\AkademikUser;
use App\Repositories\Repository;
use App\Traits\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Model;

class AkademikUserRepository extends Repository
{
    use CrudRepository;

    public function __construct()
    {
        parent::__construct(new AkademikUser());
    }

    /**
     * Create new record of the model
     *
     * @param array $entity
     * @return Model|null
     */
    public function create(array $entity): Model|null
    {
        if (!$entity) {
            return null;
        }

        return QueryBuilder::builder($this->model)
            ->build()
            ->create(array_merge($entity, ['user_id' => $entity['nim']]));
    }
}
