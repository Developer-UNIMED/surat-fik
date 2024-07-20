<?php

namespace App\Services;

use App\Repositories\Surat\JenisSuratRepository;

class JenisSuratService
{
    public function __construct(private readonly JenisSuratRepository $jenisSuratRepository)
    {
    }

}
