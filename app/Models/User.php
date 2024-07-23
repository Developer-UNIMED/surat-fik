<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, CanResetPassword, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $perPage = 15;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function akademik(): HasOne
    {
        return $this->hasOne(AkademikUser::class, 'user_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasRole(string $role): bool
    {
        return strtoupper($this->role_id) === strtoupper($role);
    }

    public function hasRoleIn(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole(trim($role))) {
                return true;
            }
        }
        return false;
    }

    public function isRegisteredViaKeycloak(): bool
    {
        return $this->password == null;
    }

    public function isValidPassword($password): bool
    {
        return Hash::check($password, $this->password);
    }
}
