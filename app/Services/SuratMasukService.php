<?php

namespace App\Services;

use App\Models\AkademikUser;
use App\Repositories\Surat\JenisSuratRepository;
use App\Repositories\Surat\SuratMasukRepository;
use App\Repositories\User\RoleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SuratMasukService
{
    public function __construct(private readonly SuratMasukRepository $suratMasukRepository,
                                private readonly JenisSuratRepository $jenisSuratRepository,
                                private readonly RoleRepository       $roleRepository)
    {
    }

    private function getAdminRoleByJurusan(string $jurusan)
    {
        $adminRoles = [
            "PEND. JASMANI, KESEHATAN DAN REKREASI" => "ADMIN_PJKR",
            "PENDIDIKAN KEPELATIHAN OLAHRAGA" => "ADMIN_PKO",
            "ILMU KEOLAHRAGAAN" => "ADMIN_IKOR",
        ];

        return $adminRoles[$jurusan];
    }

    public function findAllByUserId(string $userId): array
    {
        return $this->suratMasukRepository->findAll(where: ['created_by' => $userId])->toArray();
    }

    public function create(string $jurusan, array $data)
    {
        return DB::transaction(function () use ($jurusan, $data) {
            $jenisSuratId = $data['jenis_surat_id'];
            $adminJurusanRoleId = $this->getAdminRoleByJurusan($jurusan);

            $isJenisSuratExists = $this->jenisSuratRepository->exists($jenisSuratId);
            if (!$isJenisSuratExists) {
                throw ValidationException::withMessages([
                    'jenis_surat_id' => "Jenis Surat dengan id $jenisSuratId tidak ditemukan"
                ]);
            }

            $isAdminRoleExists = $this->roleRepository->exists($adminJurusanRoleId);
            if (!$isAdminRoleExists) {
                throw ValidationException::withMessages([
                    'jurusan' => "Role admin untuk jurusan $jurusan tidak ditemukan"
                ]);
            }

            return $this->suratMasukRepository->create([
                'jenis_surat_id' => $jenisSuratId,
                'file_path' => $data['file_path'],
                'penerima_role_id' => $adminJurusanRoleId,
                'status' => 'PENDING',
            ])->toArray();
        });
    }

}
