<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'user_id',
    'birth_date',
    'city',
    'state',
    'country',
    'professional_title',
    'professional_summary',
    'work_area',
    'years_experience',
    'education_level',
    'desired_job_type',
    'desired_modality',
    'expected_salary',
    'salary_currency',
    'salary_period',
    'availability',
    'willing_to_relocate',
    'cv_path',
    'is_visible',
    'current_step',
    'is_completed',
    'completed_at',
])]
class PerfilCandidato extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'expected_salary' => 'decimal:2',
            'willing_to_relocate' => 'boolean',
            'is_visible' => 'boolean',
            'is_completed' => 'boolean',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(CandidateExperience::class, 'candidate_profile_id');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(CandidateEducation::class, 'candidate_profile_id');
    }
}
