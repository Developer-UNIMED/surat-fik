<?php

namespace App\Repositories\Surat;

use App\Helper\QueryBuilder;
use App\Models\Role;
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

    public function findAllSuratMasukByRolePenerima(Role $role)
    {
        $whereClause = [
            'surat_masuk.status' => 'PENDING',
            'surat_masuk.penerima_role_id' => $role->id,
        ];
        if (str_starts_with($role->id, 'ADMIN')) {
            $whereClause['akademik_users.jurusan'] = $role->name;
        }

        return QueryBuilder::builder($this->model)
            ->select([
                'surat_masuk.id',
                'surat_masuk.jenis_surat_id',
                'surat_masuk.file_path',
                'jenis_surat.nama as jenis_surat',
                'akademik_users.nama as author_name',
                'akademik_users.angkatan as author_angkatan',
                'akademik_users.program_studi as author_prodi',
                'akademik_users.jurusan as author_jurusan',
            ])
            ->join('akademik_users', 'akademik_users.user_id', '=', 'surat_masuk.created_by')
            ->join('jenis_surat', 'jenis_surat.id', '=', 'surat_masuk.jenis_surat_id')
            ->where($whereClause)
            ->orderBy(['surat_masuk.created_at' => 'ASC'])
            ->build()
            ->get();
    }

    public function findAllByUserId(string $userId)
    {
        $whereClause = [
            'surat_masuk.created_by' => $userId,
        ];

        return QueryBuilder::builder($this->model)
            ->select([
                'surat_masuk.penerima_role_id',
                'surat_masuk.status',
                'surat_masuk.created_at',
                'jenis_surat.nama as jenis_surat',
            ])
            ->join('jenis_surat', 'jenis_surat.id', '=', 'surat_masuk.jenis_surat_id')
            ->where($whereClause)
            ->orderBy(['surat_masuk.created_at' => 'ASC'])
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

    public function archiveSurat(string $suratMasukId, string $roleId)
    {
        return QueryBuilder::builder($this->model)
            ->where(['id' => $suratMasukId])
            ->build()
            ->update(['penerima_role_id' => $roleId, 'status' => 'ARCHIVED']);
    }

    public function rejectSurat(string $suratMasukId)
    {
        // TODO: not yet implemented
        return true;
    }
}
