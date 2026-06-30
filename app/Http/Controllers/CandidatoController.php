<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CandidatoController extends Controller
{
    public function index(){
        return view('candidato.home');
    }

    public function onboarding()
    {
        $pendingRoute = request()->user()->pendingOnboardingRoute();

        return redirect()->route($pendingRoute ?? 'candidato.home');
    }

    public function updateDatosContacto(Request $request)
    {
        $data = $request->validateWithBag('contacto', [
            'contact_phone' => ['required', 'string', 'digits:10'],
            'contact_city' => ['required', 'string', 'max:120'],
            'contact_state' => ['required', 'string', 'max:120'],
        ], [
            'contact_phone.required' => 'El teléfono es obligatorio.',
            'contact_phone.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'contact_city.required' => 'La ciudad o municipio es obligatorio.',
            'contact_city.max' => 'La ciudad o municipio no puede exceder los 120 caracteres.',
            'contact_state.required' => 'El estado es obligatorio.',
            'contact_state.max' => 'El estado no puede exceder los 120 caracteres.',
        ]);

        $user = $request->user();

        DB::transaction(function () use ($user, $data) {
            $user->update(['phone' => $data['contact_phone']]);
            if ($user->domicilio) {
                $user->domicilio->update([
                    'delegacion_municipio' => $data['contact_city'],
                    'estado' => $data['contact_state'],
                ]);
            }
            $user->perfilCandidato()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'city' => $data['contact_city'],
                    'state' => $data['contact_state'],
                    'country' => $user->perfilCandidato?->country ?? 'Mexico',
                ]
            );
        });

        return redirect()->route('candidato.home')->with('success', 'Datos de contacto actualizados correctamente.');
    }

    public function fase1DatosPersonales(Request $request)
    {
        $user = $request->user()->loadMissing(['domicilio', 'perfilCandidato']);
        $nameParts = preg_split('/\s+/', trim($user->name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $lastName = count($nameParts) > 1 ? array_pop($nameParts) : '';
        $firstName = implode(' ', $nameParts) ?: $user->name;

        return view('candidato.onboarding', compact('user', 'firstName', 'lastName'));
    }

    public function storeFase1DatosPersonales(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:10', 'min:10'],
            'birth_date' => ['required', 'date', 'before:today'],
            'calle' => ['required', 'string', 'max:160'],
            'numero_exterior' => ['required', 'string', 'max:20'],
            'numero_interior' => ['nullable', 'string', 'max:20'],
            'codigo_postal' => ['required', 'string', 'max:10'],
            'delegacion_municipio' => ['required', 'string', 'max:120'],
            'estado' => ['required', 'string', 'max:120'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'phone.required' => 'El telefono es obligatorio.',
            'phone.min' => 'El telefono debe ser a 10 digitos',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'calle.required' => 'La calle es obligatoria.',
            'numero_exterior.required' => 'El numero exterior es obligatorio.',
            'codigo_postal.required' => 'El codigo postal es obligatorio.',
            'delegacion_municipio.required' => 'La delegacion o municipio es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
        ]);

        $user = $request->user();

        $user->update([
            'name' => trim($data['name'] . ' ' . $data['last_name']),
            'phone' => $data['phone'],
        ]);

        $user->domicilio()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'calle' => $data['calle'],
                'numero_exterior' => $data['numero_exterior'],
                'numero_interior' => $data['numero_interior'] ?? null,
                'codigo_postal' => $data['codigo_postal'],
                'delegacion_municipio' => $data['delegacion_municipio'],
                'estado' => $data['estado'],
            ]
        );

        $user->perfilCandidato()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'birth_date' => $data['birth_date'],
                'city' => $data['delegacion_municipio'],
                'state' => $data['estado'],
                'country' => 'Mexico',
                'current_step' => 2,
            ]
        );

        return redirect()->route('candidato.onboarding.fase2')->with('success', 'Datos personales guardados correctamente.');
    }

    public function fase2PerfilProfesional(Request $request)
    {
        $profile = $request->user()->perfilCandidato;

        return view('candidato.onboarding-fase2', compact('profile'));
    }

    public function storeFase2PerfilProfesional(Request $request)
    {
        $data = $request->validate([
            'professional_title' => ['required', 'string', 'max:160'],
            'professional_summary' => ['required', 'string', 'max:1200'],
            'work_area' => ['required', 'string', 'max:120'],
            'years_experience' => ['required', 'integer', 'min:0', 'max:60'],
            'education_level' => ['required', 'string', 'max:120'],
        ], [
            'professional_title.required' => 'El titulo profesional es obligatorio.',
            'professional_summary.required' => 'El resumen profesional es obligatorio.',
            'work_area.required' => 'El area laboral es obligatoria.',
            'years_experience.required' => 'Los anos de experiencia son obligatorios.',
            'years_experience.integer' => 'Los anos de experiencia deben ser un numero entero.',
            'education_level.required' => 'El nivel de estudios es obligatorio.',
        ]);

        $request->user()->perfilCandidato()->updateOrCreate(['user_id' => $request->user()->id], [
            'professional_title' => $data['professional_title'],
            'professional_summary' => $data['professional_summary'],
            'work_area' => $data['work_area'],
            'years_experience' => $data['years_experience'],
            'education_level' => $data['education_level'],
            'current_step' => 3,
        ]);

        return redirect()->route('candidato.onboarding.fase3')->with('success', 'Perfil profesional guardado correctamente.');
    }

    public function fase3PreferenciasLaborales(Request $request)
    {
        $profile = $request->user()->perfilCandidato;

        return view('candidato.onboarding-fase3', compact('profile'));
    }

    public function storeFase3PreferenciasLaborales(Request $request)
    {
        $data = $request->validate([
            'desired_job_type' => ['required', 'string', 'max:80'],
            'desired_modality' => ['required', 'string', 'max:80'],
            'expected_salary' => ['required', 'numeric', 'min:0', 'max:9999999.99'],
            'salary_currency' => ['required', 'in:MXN,USD,EUR'],
            'availability' => ['required', 'string', 'max:80'],
        ], [
            'desired_job_type.required' => 'El tipo de empleo deseado es obligatorio.',
            'desired_modality.required' => 'La modalidad deseada es obligatoria.',
            'expected_salary.required' => 'El salario esperado es obligatorio.',
            'expected_salary.numeric' => 'El salario esperado debe ser un numero.',
            'salary_currency.required' => 'La moneda del salario es obligatoria.',
            'salary_currency.in' => 'Selecciona una moneda valida.',
            'availability.required' => 'La disponibilidad es obligatoria.',
        ]);

        $request->user()->perfilCandidato()->updateOrCreate(['user_id' => $request->user()->id], [
            'desired_job_type' => $data['desired_job_type'],
            'desired_modality' => $data['desired_modality'],
            'expected_salary' => $data['expected_salary'],
            'salary_currency' => $data['salary_currency'],
            'availability' => $data['availability'],
            'current_step' => 4,
        ]);

        return redirect()->route('candidato.onboarding.fase4')->with('success', 'Preferencias laborales guardadas correctamente.');
    }

    public function fase4ExperienciaEducacion(Request $request)
    {
        $profile = $request->user()->perfilCandidato;
        $experience = $profile?->experiences()->first();
        $education = $profile?->educations()->first();

        return view('candidato.onboarding-fase4', compact('experience', 'education'));
    }

    public function storeFase4ExperienciaEducacion(Request $request)
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'experience_start_date' => ['required', 'date'],
            'experience_end_date' => ['required_unless:is_current,1', 'nullable', 'date', 'after_or_equal:experience_start_date'],
            'is_current' => ['nullable', 'boolean'],
            'experience_description' => ['nullable', 'string', 'max:2000'],
            'institution_name' => ['required', 'string', 'max:255'],
            'education_level' => ['required', 'string', 'max:120'],
            'field_of_study' => ['required', 'string', 'max:255'],
            'education_status' => ['required', 'in:cursando,terminado,trunco'],
        ], [
            'company_name.required' => 'La empresa es obligatoria.',
            'company_name.string' => 'La empresa debe ser un texto válido.',
            'company_name.max' => 'La empresa no puede exceder los 255 caracteres.',
            'position.required' => 'El puesto es obligatorio.',
            'position.string' => 'El puesto debe ser un texto válido.',
            'position.max' => 'El puesto no puede exceder los 255 caracteres.',
            'experience_start_date.required' => 'La fecha de inicio es obligatoria.',
            'experience_start_date.date' => 'La fecha de inicio no es válida.',
            'experience_end_date.required_unless' => 'La fecha de fin es obligatoria si ya no trabajas aquí.',
            'experience_end_date.date' => 'La fecha de fin no es válida.',
            'experience_end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'is_current.boolean' => 'La opción de trabajo actual no es válida.',
            'experience_description.string' => 'La descripción debe ser un texto válido.',
            'experience_description.max' => 'La descripción no puede exceder los 2000 caracteres.',
            'institution_name.required' => 'La institución es obligatoria.',
            'institution_name.string' => 'La institución debe ser un texto válido.',
            'institution_name.max' => 'La institución no puede exceder los 255 caracteres.',
            'education_level.required' => 'El nivel de estudios es obligatorio.',
            'education_level.string' => 'El nivel de estudios no es válido.',
            'education_level.max' => 'El nivel de estudios no puede exceder los 120 caracteres.',
            'field_of_study.required' => 'La carrera o especialidad es obligatoria.',
            'field_of_study.string' => 'La carrera o especialidad debe ser un texto válido.',
            'field_of_study.max' => 'La carrera o especialidad no puede exceder los 255 caracteres.',
            'education_status.required' => 'El estado de los estudios es obligatorio.',
            'education_status.in' => 'Selecciona un estado de estudios válido.',
        ]);

        $profile = $request->user()->perfilCandidato;
        $isCurrent = $request->boolean('is_current');

        DB::transaction(function () use ($profile, $data, $isCurrent) {
            $experience = $profile->experiences()->firstOrNew();
            $experience->fill([
                'company_name' => $data['company_name'],
                'position' => $data['position'],
                'start_date' => $data['experience_start_date'],
                'end_date' => $isCurrent ? null : $data['experience_end_date'],
                'is_current' => $isCurrent,
                'description' => $data['experience_description'] ?? null,
            ])->save();

            $education = $profile->educations()->firstOrNew();
            $education->fill([
                'institution_name' => $data['institution_name'],
                'education_level' => $data['education_level'],
                'field_of_study' => $data['field_of_study'],
                'status' => $data['education_status'],
            ])->save();

            $profile->update(['current_step' => 5]);
        });

        return redirect()->route('candidato.onboarding.fase5')->with('success', 'Experiencia y educación guardadas correctamente.');
    }

    public function fase5CvFinalizacion(Request $request)
    {
        $profile = $request->user()->perfilCandidato;
        $cvSize = $profile?->cv_path && Storage::disk('public')->exists($profile->cv_path)
            ? Storage::disk('public')->size($profile->cv_path)
            : null;

        return view('candidato.onboarding-fase5', compact('profile', 'cvSize'));
    }

    public function storeFase5CvFinalizacion(Request $request)
    {
        $profile = $request->user()->perfilCandidato;

        $data = $request->validate([
            'cv' => [$profile?->cv_path ? 'nullable' : 'required', 'file', 'mimes:pdf', 'max:10240'],
            'is_visible' => ['nullable', 'boolean'],
        ]);

        $cvPath = isset($data['cv'])
            ? $data['cv']->store('cvs/' . $request->user()->id, 'public')
            : $profile->cv_path;

        $profile->update([
            'cv_path' => $cvPath,
            'is_visible' => $request->boolean('is_visible'),
            'is_completed' => true,
            'completed_at' => now(),
            'current_step' => 5,
        ]);

        return redirect()->route('candidato.home')->with('success', 'Tu perfil se completó correctamente.');
    }
}
