<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Experiencia y educación | EmpleaPro</title>
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
                    Fase 4: Experiencia y educación
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
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-blanco sm:text-4xl">Comparte tu trayectoria</h1>
                    <p class="mt-4 text-sm leading-6 text-blanco/70">
                        Agrega tu experiencia más reciente y los estudios que mejor representan tu preparación.
                    </p>

                    <div class="mt-8">
                        <div class="h-2 overflow-hidden rounded-full bg-blanco/10">
                            <div class="h-full w-4/5 rounded-full bg-verde-claro"></div>
                        </div>
                        <div class="mt-4 grid grid-cols-5 gap-2 text-center text-xs font-semibold">
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">01</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">02</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">03</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">04</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">05</span>
                        </div>
                    </div>

                    <dl class="mt-8 space-y-4 text-sm">
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Experiencia laboral</dt>
                            <dd class="mt-1 text-blanco/65">Tu empleo más reciente y las actividades que realizaste.</dd>
                        </div>
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Educación</dt>
                            <dd class="mt-1 text-blanco/65">Tu institución, nivel académico y especialidad.</dd>
                        </div>
                    </dl>
                </aside>

                <section class="p-5 sm:p-8">
                    <div class="mb-6 border-b border-fondo-secundario/10 pb-5">
                        <p class="text-sm font-bold text-primario">Fase 4</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-fondo-secundario">Experiencia y educación</h2>
                    </div>

                    <form class="space-y-8" method="POST" action="{{ route('candidato.onboarding.fase4.store') }}" novalidate>
                        @csrf
                        <fieldset class="grid gap-5 sm:grid-cols-2">
                            <legend class="mb-5 w-full border-b border-fondo-secundario/10 pb-3 text-lg font-extrabold text-fondo-secundario">
                                Experiencia laboral
                            </legend>

                            <div>
                                <label for="company_name" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Empresa</label>
                                <input id="company_name" name="company_name" type="text" placeholder="Ej. EmpleaPro" value="{{ old('company_name', $experience?->company_name) }}"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                @error('company_name')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="position" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Puesto</label>
                                <input id="position" name="position" type="text" placeholder="Ej. Desarrollador web" value="{{ old('position', $experience?->position) }}"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                @error('position')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="experience_start_date" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Fecha de inicio</label>
                                <input id="experience_start_date" name="experience_start_date" type="date" value="{{ old('experience_start_date', $experience?->start_date?->format('Y-m-d')) }}"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                @error('experience_start_date')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="experience_end_date" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Fecha de fin</label>
                                <input id="experience_end_date" name="experience_end_date" type="date"
                                    value="{{ old('is_current', $experience?->is_current) ? '' : old('experience_end_date', $experience?->end_date?->format('Y-m-d')) }}" @disabled(old('is_current', $experience?->is_current))
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15 disabled:cursor-not-allowed disabled:opacity-50">
                                @error('experience_end_date')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="inline-flex cursor-pointer items-center gap-3 text-sm font-semibold text-fondo-secundario">
                                    <input name="is_current" type="hidden" value="0">
                                    <input id="is_current" name="is_current" type="checkbox" value="1" @checked(old('is_current', $experience?->is_current))
                                        class="h-4 w-4 rounded border-fondo-secundario/20 text-primario focus:ring-primario/20">
                                    Trabajo actualmente aquí
                                </label>
                                @error('is_current')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="experience_description" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Descripción de actividades</label>
                                <textarea id="experience_description" name="experience_description" rows="4" placeholder="Describe brevemente tus principales responsabilidades"
                                    class="w-full resize-y rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">{{ old('experience_description', $experience?->description) }}</textarea>
                                @error('experience_description')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>
                        </fieldset>

                        <fieldset class="grid gap-5 sm:grid-cols-2">
                            <legend class="mb-5 w-full border-b border-fondo-secundario/10 pb-3 text-lg font-extrabold text-fondo-secundario">
                                Educación
                            </legend>

                            <div>
                                <label for="institution_name" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Institución</label>
                                <input id="institution_name" name="institution_name" type="text" placeholder="Ej. Universidad Nacional" value="{{ old('institution_name', $education?->institution_name) }}"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                @error('institution_name')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="education_level" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Nivel de estudios</label>
                                <select id="education_level" name="education_level"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                    <option value="">Selecciona un nivel</option>
                                    <option value="secundaria" @selected(old('education_level', $education?->education_level) === 'secundaria')>Secundaria</option>
                                    <option value="bachillerato" @selected(old('education_level', $education?->education_level) === 'bachillerato')>Bachillerato</option>
                                    <option value="tecnico" @selected(old('education_level', $education?->education_level) === 'tecnico')>Técnico</option>
                                    <option value="tsu" @selected(old('education_level', $education?->education_level) === 'tsu')>TSU</option>
                                    <option value="licenciatura" @selected(old('education_level', $education?->education_level) === 'licenciatura')>Licenciatura</option>
                                    <option value="maestria" @selected(old('education_level', $education?->education_level) === 'maestria')>Maestría</option>
                                    <option value="doctorado" @selected(old('education_level', $education?->education_level) === 'doctorado')>Doctorado</option>
                                    <option value="curso" @selected(old('education_level', $education?->education_level) === 'curso')>Curso</option>
                                    <option value="certificacion" @selected(old('education_level', $education?->education_level) === 'certificacion')>Certificación</option>
                                </select>
                                @error('education_level')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="field_of_study" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Carrera o especialidad</label>
                                <input id="field_of_study" name="field_of_study" type="text" placeholder="Ej. Ingeniería en sistemas" value="{{ old('field_of_study', $education?->field_of_study) }}"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                @error('field_of_study')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="education_status" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Estado</label>
                                <select id="education_status" name="education_status"
                                    class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                    <option value="">Selecciona un estado</option>
                                    <option value="cursando" @selected(old('education_status', $education?->status) === 'cursando')>Cursando</option>
                                    <option value="terminado" @selected(old('education_status', $education?->status) === 'terminado')>Terminado</option>
                                    <option value="trunco" @selected(old('education_status', $education?->status) === 'trunco')>Trunco</option>
                                </select>
                                @error('education_status')
                                    <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                                @enderror
                            </div>
                        </fieldset>

                        <div class="flex flex-col-reverse gap-3 border-t border-fondo-secundario/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                            <a href="{{ route('candidato.onboarding.fase3') }}"
                                class="inline-flex justify-center rounded-md bg-fondo-campo px-5 py-3 text-sm font-semibold text-fondo-secundario transition hover:bg-fondo-secundario/10">
                                Volver
                            </a>
                            <button type="submit"
                                class="rounded-md bg-primario px-6 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">
                                Continuar
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
    <script>
        const isCurrentCheckbox = document.getElementById('is_current');
        const experienceEndDate = document.getElementById('experience_end_date');

        function toggleExperienceEndDate() {
            if (isCurrentCheckbox.checked) {
                experienceEndDate.value = '';
            }

            experienceEndDate.disabled = isCurrentCheckbox.checked;
        }

        isCurrentCheckbox.addEventListener('change', toggleExperienceEndDate);
        toggleExperienceEndDate();
    </script>
</body>

</html>
