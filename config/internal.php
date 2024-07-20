<?php

return [

    'api' => [
        'akademik' => [
            'base_url' => env('API_AKADEMIK_BASE_URL', ''),
            'username' => env('API_AKADEMIK_USERNAME', ''),
            'password' => env('API_AKADEMIK_PASSWORD', ''),
            'endpoints' => [
                'find_mahasiswa_by_nim' => env('API_AKADEMIK_ENDPOINT_MAHASISWA_FIND_BY_NIM', ''),
            ],
        ],
    ],

];
