<?php

namespace App\Repositories\Surat;

use App\Models\JenisSurat;
use App\Repositories\Repository;
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
