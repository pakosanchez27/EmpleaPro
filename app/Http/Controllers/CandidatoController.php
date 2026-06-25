<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function fase1DatosPersonales()
    {
        return view('candidato.onboarding');
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

    public function fase2PerfilProfesional()
    {
        return view('candidato.onboarding-fase2');
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

    public function fase3PreferenciasLaborales()
    {
        return view('candidato.onboarding-fase3');
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
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        return redirect()->route('candidato.home')->with('success', 'Preferencias laborales guardadas correctamente.');
    }
}
