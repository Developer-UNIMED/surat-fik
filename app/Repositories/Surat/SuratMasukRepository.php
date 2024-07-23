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

    public function findAllSuratMasukByRolePenerima(string $roleId)
    {
        return QueryBuilder::builder($this->model)
            ->select([
                'surat_masuk.id',
                'surat_masuk.jenis_surat_id',
                'surat_masuk.file_path',
                'akademik_users.nama as author_name',
                'akademik_users.angkatan as author_angkatan',
                'akademik_users.program_studi as author_prodi',
                'akademik_users.jurusan as author_jurusan',
            ])
            ->join('akademik_users', 'akademik_users.id', '=', 'surat_masuk.created_by')
            ->where([
                ['surat_masuk.deleted_at', '=', null],
                ['surat_masuk.penerima_role_id', '=', $roleId]
            ])
            ->orderBy(['created_at' => 'ASC'])
            ->build()
            ->get();
    }

    public function forwardSurat(string $suratMasukId, string $roleId)
    {
        return QueryBuilder::builder($this->model)
            ->where(['id' => $suratMasukId])
            ->build()
            ->update(['penerima_role_id' => $roleId]);
    }

    public function rejectSurat(string $suratMasukId)
    {
        // TODO: not yet implemented
        return true;
    }
}
