<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preferencias laborales | EmpleaPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-fondo-principal text-fondo-secundario antialiased">
    <main class="min-h-screen px-4 py-6 sm:px-8 lg:py-8">
        <section class="mx-auto w-full max-w-6xl">
            <header class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-md bg-primario text-blanco shadow-sm">
                        <span class="h-4 w-4 rounded-sm bg-blanco"></span>
                    </span>
                    <span class="text-2xl font-extrabold">EmpleaPro</span>
                </a>

                <div class="flex items-center gap-2 rounded-md bg-blanco px-3 py-2 text-xs font-bold text-fondo-secundario shadow-sm ring-1 ring-fondo-secundario/10">
                    <span class="h-2 w-2 rounded-full bg-primario"></span>
                    Fase 3: Preferencias laborales
                </div>
            </header>

            @if (session('success'))
                <div class="mb-6 rounded-md bg-verde-claro/15 px-4 py-3 text-sm font-semibold text-primario">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid overflow-hidden rounded-lg bg-blanco shadow-sm ring-1 ring-fondo-secundario/10 lg:grid-cols-[0.8fr_1.2fr]">
                <aside class="bg-fondo-secundario p-6 text-blanco sm:p-8">
                    <p class="text-sm font-bold text-verde-claro">Perfil de candidato</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-blanco sm:text-4xl">Cuenta que tipo de trabajo buscas</h1>
                    <p class="mt-4 text-sm leading-6 text-blanco/70">
                        Estas preferencias ayudan a ordenar oportunidades segun tu disponibilidad, modalidad y expectativa salarial.
                    </p>

                    <div class="mt-8">
                        <div class="h-2 overflow-hidden rounded-full bg-blanco/10">
                            <div class="h-full w-3/4 rounded-full bg-verde-claro"></div>
                        </div>
                        <div class="mt-4 grid grid-cols-4 gap-2 text-center text-xs font-semibold">
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">01</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">02</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">03</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">04</span>
                        </div>
                    </div>

                    <dl class="mt-8 space-y-4 text-sm">
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Preferencias laborales</dt>
                            <dd class="mt-1 text-blanco/65">Tipo de empleo, modalidad, salario y disponibilidad.</dd>
                        </div>
                        <div class="border-l-2 border-blanco/15 pl-4">
                            <dt class="font-bold text-blanco/55">Siguiente fase</dt>
                            <dd class="mt-1 text-blanco/45">Habilidades y documentacion.</dd>
                        </div>
                    </dl>
                </aside>

                <section class="p-5 sm:p-8">
                    <div class="mb-6 border-b border-fondo-secundario/10 pb-5">
                        <p class="text-sm font-bold text-primario">Fase 3</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-fondo-secundario">Preferencias laborales</h2>
                    </div>

                    <form class="grid gap-5 sm:grid-cols-2" method="POST" action="{{ route('candidato.onboarding.fase3.store') }}" novalidate>
                        @csrf

                        <div>
                            <label for="desired_job_type" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Tipo de empleo deseado
                            </label>
                            <select
                                id="desired_job_type"
                                name="desired_job_type"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona una opcion</option>
                                <option value="tiempo_completo" @selected(old('desired_job_type', auth()->user()?->perfilCandidato?->desired_job_type) === 'tiempo_completo')>Tiempo completo</option>
                                <option value="medio_tiempo" @selected(old('desired_job_type', auth()->user()?->perfilCandidato?->desired_job_type) === 'medio_tiempo')>Medio tiempo</option>
                                <option value="practicas" @selected(old('desired_job_type', auth()->user()?->perfilCandidato?->desired_job_type) === 'practicas')>Practicas</option>
                                <option value="freelance" @selected(old('desired_job_type', auth()->user()?->perfilCandidato?->desired_job_type) === 'freelance')>Freelance</option>
                                <option value="temporal" @selected(old('desired_job_type', auth()->user()?->perfilCandidato?->desired_job_type) === 'temporal')>Temporal</option>
                            </select>
                            @error('desired_job_type')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="desired_modality" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Modalidad deseada
                            </label>
                            <select
                                id="desired_modality"
                                name="desired_modality"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona una modalidad</option>
                                <option value="presencial" @selected(old('desired_modality', auth()->user()?->perfilCandidato?->desired_modality) === 'presencial')>Presencial</option>
                                <option value="remoto" @selected(old('desired_modality', auth()->user()?->perfilCandidato?->desired_modality) === 'remoto')>Remoto</option>
                                <option value="hibrido" @selected(old('desired_modality', auth()->user()?->perfilCandidato?->desired_modality) === 'hibrido')>Hibrido</option>
                            </select>
                            @error('desired_modality')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="expected_salary" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Salario esperado
                            </label>
                            <input
                                id="expected_salary"
                                name="expected_salary"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="Ej. 18000"
                                value="{{ old('expected_salary', auth()->user()?->perfilCandidato?->expected_salary) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('expected_salary')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="salary_currency" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Tipo de moneda
                            </label>
                            <select
                                id="salary_currency"
                                name="salary_currency"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona moneda</option>
                                <option value="MXN" @selected(old('salary_currency', auth()->user()?->perfilCandidato?->salary_currency) === 'MXN')>MXN</option>
                                <option value="USD" @selected(old('salary_currency', auth()->user()?->perfilCandidato?->salary_currency) === 'USD')>USD</option>
                                <option value="EUR" @selected(old('salary_currency', auth()->user()?->perfilCandidato?->salary_currency) === 'EUR')>Euro</option>
                            </select>
                            @error('salary_currency')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="availability" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Disponibilidad
                            </label>
                            <select
                                id="availability"
                                name="availability"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona tu disponibilidad</option>
                                <option value="inmediata" @selected(old('availability', auth()->user()?->perfilCandidato?->availability) === 'inmediata')>Inmediata</option>
                                <option value="una_semana" @selected(old('availability', auth()->user()?->perfilCandidato?->availability) === 'una_semana')>Una semana</option>
                                <option value="quince_dias" @selected(old('availability', auth()->user()?->perfilCandidato?->availability) === 'quince_dias')>Quince dias</option>
                                <option value="un_mes" @selected(old('availability', auth()->user()?->perfilCandidato?->availability) === 'un_mes')>Un mes</option>
                            </select>
                            @error('availability')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col-reverse gap-3 border-t border-fondo-secundario/10 pt-5 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <a
                                href="{{ route('candidato.onboarding.fase2') }}"
                                class="inline-flex justify-center rounded-md bg-fondo-campo px-5 py-3 text-sm font-semibold text-fondo-secundario transition hover:bg-fondo-secundario/10">
                                Volver
                            </a>
                            <button
                                type="submit"
                                class="rounded-md bg-primario px-6 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">
                                Continuar
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
</body>

</html>
