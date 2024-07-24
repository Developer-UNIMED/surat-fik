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
                    message: 'MAHASISWA_REMOTE_FIND_BY_NIM',
                    context: ['message' => 'Response body is empty or has error_code',
                        'params' => ['KdMahasiswa' => $nim],
                        'response' => [
                            'status' => $response->status(),
                            'headers' => $response->headers(),
                            'body' => $response->body()
                        ]
                    ]);

                return null;
            }

            $data = $response->json()[0];
            Log::info(
                message: 'MAHASISWA_REMOTE_FIND_BY_NIM',
                context: [
                    'message' => 'OK',
                    'params' => ['KdMahasiswa' => $nim],
                    'data' => $data
                ]);

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
                'password' => $data['Password'],
                'password_salt' => $data['Salt'],
            ];
        } catch (ConnectionException $e) {
            Log::error(
                message: 'MAHASISWA_REMOTE_FIND_BY_NIM',
                context: [
                    'message' => "Error: {$e->getMessage()}",
                    'params' => ['KdMahasiswa' => $nim],
                    'exception' => (array)$e,
                ]);

            return null;
        }
    }
}
