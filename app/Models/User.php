<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\VerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'is_active',
    'last_login_at',
    'password_changed_at',
    'failed_login_attempts',
    'locked_until',
    'phone',
    'avatar',
    'created_by',
    'updated_by',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

      public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
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
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'locked_until' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function domicilio(): HasOne
    {
        return $this->hasOne(Domicilio::class);
    }

    public function perfilCandidato(): HasOne
    {
        return $this->hasOne(PerfilCandidato::class);
    }

    public function hasRole(string $slug): bool
    {
        return $this->roles()->where('slug', $slug)->exists();
    }

    public function needsFase1DatosPersonales(): bool
    {
        $perfil = $this->perfilCandidato;

        return blank($this->name)
            || blank($this->phone)
            || $perfil === null
            || blank($perfil->birth_date)
            || blank($perfil->city)
            || blank($perfil->state)
            || blank($perfil->country)
            || $this->domicilio === null
            || blank($this->domicilio->calle)
            || blank($this->domicilio->numero_exterior)
            || blank($this->domicilio->codigo_postal)
            || blank($this->domicilio->delegacion_municipio)
            || blank($this->domicilio->estado);
    }

    public function needsFase2PerfilProfesional(): bool
    {
        $perfil = $this->perfilCandidato;

        return $perfil === null
            || blank($perfil->professional_title)
            || blank($perfil->professional_summary)
            || blank($perfil->work_area)
            || $perfil->years_experience === null
            || blank($perfil->education_level);
    }

    public function needsFase3PreferenciasLaborales(): bool
    {
        $perfil = $this->perfilCandidato;

        return $perfil === null
            || blank($perfil->desired_job_type)
            || blank($perfil->desired_modality)
            || $perfil->expected_salary === null
            || blank($perfil->salary_currency)
            || blank($perfil->availability);
    }

    public function pendingOnboardingRoute(): ?string
    {
        if (! $this->hasRole('candidato')) {
            return null;
        }

        if ($this->needsFase1DatosPersonales()) {
            return 'candidato.onboarding.fase1';
        }

        if ($this->needsFase2PerfilProfesional()) {
            return 'candidato.onboarding.fase2';
        }

        if ($this->needsFase3PreferenciasLaborales()) {
            return 'candidato.onboarding.fase3';
        }

        return null;
    }
}
