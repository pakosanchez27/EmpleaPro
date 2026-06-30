<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PerfilCandidato;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
        'candidate_profile_id',
        'company_name',
        'position',
        'start_date',
        'end_date',
        'is_current',
        'description',
    ])]
class CandidateExperience extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
        ];
    }

    public function candidateProfile(): BelongsTo
    {
        return $this->belongsTo(PerfilCandidato::class, 'candidate_profile_id');
    }
}
