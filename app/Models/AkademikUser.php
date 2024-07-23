<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkademikUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'akademik_users';
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    protected $perPage = 15;

    public $incrementing = false;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'nama',
        'angkatan',
        'jenjang',
        'program_studi',
        'jurusan',
        'fakultas',
        'mobile',
        'alamat',
        'tanggal_lahir',
    ];

    protected $hidden = [];
}
