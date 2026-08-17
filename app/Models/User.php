<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'cargo', 'perfil'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements HasName, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Libera o acesso ao painel do Filament para todos os usuários cadastrados.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Retorna "true" permitindo que todos com conta acessem
    }

    /**
     * Exibe o Nome e o Cargo concatenados no cabeçalho do Filament.
     */
    public function getFilamentName(): string
    {
        $cargo = $this->cargo ? " - {$this->cargo}" : '';

        return "{$this->name}{$cargo}";
    }

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

    /**
     * Relacionamento com as movimentações realizadas pelo usuário.
     */
    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'usuario_id');
    }
}
