<?php

namespace App\Repositories;

use App\Models\JenisSurat;
use App\Traits\Repositories\CrudRepository;
use App\Traits\Repositories\PagingRepository;

class JenisSuratRepository extends Repository
{
    use CrudRepository, PagingRepository;

    public function __construct()
    {
        parent::__construct(new JenisSurat());
    }
}
