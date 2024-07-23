<?php

namespace App\Services;

use App\Repositories\Surat\SuratMasukRepository;
use App\Repositories\User\RoleRepository;
use Illuminate\Validation\ValidationException;

class ValidasiSuratService
{
    public function __construct(private readonly RoleRepository       $roleRepository,
                                private readonly SuratMasukRepository $suratMasukRepository)
    {
    }

    public function findAllPenerimaSuratRole(): array
    {
        return $this->roleRepository->findAllPenerimaSurat(['id', 'name'])->toArray();
    }

    public function findAllSuratMasukByRolePenerima(string $roleId): array
    {
        $result = [];
        $listSuratMasuk = $this->suratMasukRepository->findAllSuratMasukByRolePenerima($roleId);

        foreach ($listSuratMasuk as $suratMasuk) {
            $result[] = [
                $suratMasuk['id'],
                $suratMasuk['jenis_surat_id'],
                $suratMasuk['file_path'],
                'author' => [
                    $suratMasuk['name'],
                    $suratMasuk['angkatan'],
                    $suratMasuk['prodi'],
                    $suratMasuk['jurusan'],
                ],
            ];
        }

        return $result;
    }

    public function forwardSurat(string $suratMasukId, string $roleId): int
    {
        $isSuratMasukExists = $this->suratMasukRepository->exists($suratMasukId);
        if (!$isSuratMasukExists) {
            throw ValidationException::withMessages([
                'surat_masuk_id' => "Surat dengan id $suratMasukId tidak ditemukan",
            ]);
        }

        $isRoleExists = $this->roleRepository->exists($roleId);
        if (!$isRoleExists) {
            throw ValidationException::withMessages([
                'role_id' => "Role dengan id $roleId tidak ditemukan",
            ]);
        }

        $badForwardRoles = ['USER', 'ADMIN', 'DEV'];
        if (in_array($roleId, $badForwardRoles)) {
            throw ValidationException::withMessages([
                'role_id' => "Surat tidak dapat diteruskan ke role $roleId",
            ]);
        }

        return $this->suratMasukRepository->forwardSurat($suratMasukId, $roleId);
    }

    public function rejectSurat(string $suratMasukId)
    {
        $isSuratMasukExists = $this->suratMasukRepository->exists($suratMasukId);
        if (!$isSuratMasukExists) {
            throw ValidationException::withMessages([
                'surat_masuk_id' => "Surat dengan id $suratMasukId tidak ditemukan",
            ]);
        }

        return $this->suratMasukRepository->rejectSurat($suratMasukId);
    }
}
