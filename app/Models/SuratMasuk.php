<?php

namespace App\Models;

use App\Traits\Model\HasFingerprint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SuratMasuk extends Model
{
    use HasFactory, HasFingerprint, Notifiable, SoftDeletes;

    protected $table = 'surat_masuk';
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    protected $perPage = 15;

    public $incrementing = false;

    protected string $CREATED_BY = 'created_by';
    protected string $UPDATED_BY = 'updated_by';
    protected string $DELETED_BY = 'deleted_by';

    protected $fillable = [
        'id',
        'jenis_surat_id',
        'file_path',
        'penerima_role_id',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [];
}
