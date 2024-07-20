<?php

namespace App\Repositories\Remote;

use App\Helper\StringUtils;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AkademikRemoteRepository
{
    public function findUserByNIM(string $nim): array|null
    {
        try {
            $baseUrl = config('internal.api.akademik.base_url');
            $endpoint = config('internal.api.akademik.endpoints.find_mahasiswa_by_nim');
            $response = Http::timeout(5)
                ->connectTimeout(5)
                ->asForm()->acceptJson()
                ->post(url: $baseUrl . $endpoint, data: [
                    'username' => config('internal.api.akademik.username'),
                    'password' => config('internal.api.akademik.password'),
                    'KdMahasiswa' => $nim
                ]);

            if (!$response->json() || $response->json('error_code')) {
                Log::error(
                    message: 'AKADEMIK_REMOTE_FIND_BY_NIM',
                    context: ['message' => 'Error', 'nim' => $nim,
                        'status' => $response->status(),
                        'headers' => $response->headers(),
                        'response' => $response->json()]);
                return null;
            }

            $data = $response->json()[0];
            Log::info(
                message: 'AKADEMIK_REMOTE_FIND_BY_NIM',
                context: ['message' => 'Success', 'nim' => $nim, 'response' => $data]);
            return [
                'nim' => $nim,
                'nama' => $data['nama'],
                'angkatan' => $data['angkatan'],
                'jenjang' => $data['jenjang'],
                'program_studi' => $data['NmProdi'],
                'jurusan' => $data['NmJurusan'],
                'fakultas' => $data['NmFakultas'],
                'mobile' => StringUtils::normalizePhoneNumber($data['NoTelp']),
                'alamat' => $data['AlmtRumah'],
                'tanggal_lahir' => $data['TglLahir'],
            ];
        } catch (ConnectionException $e) {
            Log::error(
                message: 'AKADEMIK_REMOTE_FIND_BY_NIM',
                context: ['message' => 'Error exception', 'nim' => $nim, 'exception' => (array)$e]);
            return null;
        }
    }
}
