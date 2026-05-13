<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * Papéis que podem aceder ao painel Filament (inclui nomes do dump SQL legado).
     *
     * @return list<string>
     */
    public static function filamentPanelRoles(): array
    {
        return [
            'super_admin',
            'super-admin',
            'admin',
        ];
    }

    /**
     * Papéis que podem gerir Utilizadores / Papéis no Filament.
     *
     * @return list<string>
     */
    public static function filamentAdministrationRoles(): array
    {
        return [
            'super_admin',
            'super-admin',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organizador_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(static::filamentPanelRoles());
    }

    public function organizador(): BelongsTo
    {
        return $this->belongsTo(Organizadores::class, 'organizador_id');
    }
}
