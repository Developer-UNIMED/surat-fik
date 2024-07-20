<?php

namespace App\Repositories\Surat;

use App\Helper\QueryBuilder;
use App\Models\SuratMasuk;
use App\Repositories\Repository;
use App\Traits\Repositories\CrudRepository;
use App\Traits\Repositories\PagingRepository;

class SuratMasukRepository extends Repository
{
    use CrudRepository, PagingRepository;

    public function __construct()
    {
        parent::__construct(new SuratMasuk());
    }

    public function getSuratMasukByValidatorRole(array $select, string $validatorRoleId)
    {
        return QueryBuilder::builder($this->model)
            ->select($select)
            ->join('jenis_surat', 'jenis_surat.id', '=', 'surat_masuk.jenis_surat_id')
            ->leftJoin('disposisi_surat', 'disposisi_surat.surat_masuk_id', '=', 'surat_masuk.id')
            ->where([
                ['surat_masuk.deleted_at', '=', null],
                ['jenis_surat.deleted_at', '=', null],
                ['jenis_surat.validator_role_id', '=', $validatorRoleId],
                ['disposisi_surat.id', '=', null],
            ])
            ->build()
            ->get();
    }
}
