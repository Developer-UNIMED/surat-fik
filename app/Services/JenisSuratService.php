<?php

namespace App\Services;

use App\Repositories\Surat\JenisSuratRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class JenisSuratService
{
    public function __construct(private readonly JenisSuratRepository $jenisSuratRepository)
    {
    }

    public function findAll()
    {
        $result = [];
        $jenisSuratList = $this->jenisSuratRepository->findAll(
            select: ['id', 'nama', 'icon_path', 'deskripsi']);

        foreach ($jenisSuratList as $jenisSurat) {
            $result[] = [
                'id' => $jenisSurat->id,
                'nama' => $jenisSurat->nama,
                'icon_path' => Storage::url($jenisSurat->icon_path),
                'deskripsi' => $jenisSurat->deskripsi,
            ];
        }
        return $result;
    }

    public function findById(string $id)
    {
        $jenisSurat = $this->jenisSuratRepository->findById($id);
        if (!$jenisSurat) {
            throw ValidationException::withMessages([
                'id' => "Jenis Surat dengan id $id tidak ditemukan"
            ]);
        }

        return [
            'id' => $jenisSurat->id,
            'nama' => $jenisSurat->nama,
            'icon_path' => Storage::url($jenisSurat->icon_path),
            'file_path' => Storage::url($jenisSurat->file_path),
            'deskripsi' => $jenisSurat->deskripsi,
        ];
    }

    public function create(array $data)
    {
        return $this->jenisSuratRepository->create([
            'id' => $data['id'],
            'nama' => $data['nama'],
            'icon_path' => $data['icon_path'],
            'file_path' => $data['file_path'],
            'deskripsi' => $data['deskripsi'],
        ]);
    }

    public function update(string $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $jenisSurat = $this->jenisSuratRepository->findById($id);
            if (!$jenisSurat) {
                throw ValidationException::withMessages([
                    'id' => "Jenis Surat dengan id $id tidak ditemukan"
                ]);
            }

            return $this->jenisSuratRepository->update($id, [
                'nama' => $data['nama'],
                'icon_path' => $data['icon_path'],
                'file_path' => $data['file_path'],
                'deskripsi' => $data['deskripsi'],
            ]);
        });
    }

    public function delete(string $id): int
    {
        return DB::transaction(function () use ($id) {
            $jenisSurat = $this->jenisSuratRepository->findById($id);
            if (!$jenisSurat) {
                throw ValidationException::withMessages([
                    'id' => "Jenis Surat dengan id $id tidak ditemukan"
                ]);
            }

            Storage::delete($jenisSurat->icon_path);
            Storage::delete($jenisSurat->file_path);
            return $this->jenisSuratRepository->delete($id);
        });
    }
}
