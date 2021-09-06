<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasMediaUpload;
use Laravel\Sanctum\HasApiTokens;
use App\Casts\{CPF, Password, Phone};
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $cpf
 * @property string $avatar
 * @property string $phone
 * @property string $marital_status
 * @property string $gender
 * @property boolean $admin
 * @property string $password
 * @property Carbon|null $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasMediaUpload;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'phone',
        'marital_status',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => Password::class,
        'phone' => Phone::class,
        'cpf' => CPF::class,
        'admin' => 'boolean'
    ];

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function getAvatarAttribute(): string
    {
        return asset($this->getFirstMediaUrl('avatar'));
    }

    public function registerMediaCollections(): void
    {
        $avatarFallback = '/images/no-avatar.png';

        $this->addMediaCollection('avatar')
            ->useDisk('users')
            ->useFallbackPath(public_path($avatarFallback))
            ->useFallbackUrl($avatarFallback)
            ->singleFile();
    }
}
