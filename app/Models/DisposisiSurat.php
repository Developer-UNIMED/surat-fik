<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DisposisiSurat extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'disposisi_surat';
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    protected $perPage = 15;

    public $incrementing = false;

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'surat_masuk_id',
        'pengirim_id',
        'penerima_id',
        'status',
        'catatan',
    ];

    protected $hidden = [];
}
