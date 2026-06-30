<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'candidate_profile_id',
        'institution_name',
        'education_level',
        'field_of_study',
        'status',
    ])]
class CandidateEducation extends Model
{
    use SoftDeletes;
    protected $table = 'candidate_educations';

    public function candidateProfile(): BelongsTo
    {
        return $this->belongsTo(PerfilCandidato::class, 'candidate_profile_id');
    }
}
