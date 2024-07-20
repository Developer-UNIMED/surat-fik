<?php

namespace App\Services;

use App\Repositories\JenisSuratRepository;

class JenisSuratService
{
    public function __construct(private readonly JenisSuratRepository $jenisSuratRepository)
    {
    }

}
