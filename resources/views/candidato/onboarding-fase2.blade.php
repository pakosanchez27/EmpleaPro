<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil profesional | EmpleaPro</title>
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
                    Fase 2: Perfil profesional
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
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-blanco sm:text-4xl">Define tu perfil profesional</h1>
                    <p class="mt-4 text-sm leading-6 text-blanco/70">
                        Resume tu experiencia, area laboral y nivel de estudios para que las empresas entiendan rapido tu perfil.
                    </p>

                    <div class="mt-8">
                        <div class="h-2 overflow-hidden rounded-full bg-blanco/10">
                            <div class="h-full w-2/4 rounded-full bg-verde-claro"></div>
                        </div>
                        <div class="mt-4 grid grid-cols-4 gap-2 text-center text-xs font-semibold">
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">01</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">02</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">03</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">04</span>
                        </div>
                    </div>

                    <dl class="mt-8 space-y-4 text-sm">
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Perfil profesional</dt>
                            <dd class="mt-1 text-blanco/65">Titulo, resumen, area y estudios.</dd>
                        </div>
                        <div class="border-l-2 border-blanco/15 pl-4">
                            <dt class="font-bold text-blanco/55">Siguiente fase</dt>
                            <dd class="mt-1 text-blanco/45">Preferencias laborales.</dd>
                        </div>
                    </dl>
                </aside>

                <section class="p-5 sm:p-8">
                    <div class="mb-6 border-b border-fondo-secundario/10 pb-5">
                        <p class="text-sm font-bold text-primario">Fase 2</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-fondo-secundario">Perfil profesional</h2>
                    </div>

                    <form class="grid gap-5 sm:grid-cols-2" method="POST" action="{{ route('candidato.onboarding.fase2.store') }}" novalidate>
                        @csrf

                        <div class="sm:col-span-2">
                            <label for="professional_title" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Titulo profesional
                            </label>
                            <input
                                id="professional_title"
                                name="professional_title"
                                type="text"
                                placeholder="Ej. Desarrollador web junior"
                                value="{{ old('professional_title', auth()->user()?->perfilCandidato?->professional_title) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('professional_title')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="professional_summary" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Resumen profesional
                            </label>
                            <textarea
                                id="professional_summary"
                                name="professional_summary"
                                rows="5"
                                placeholder="Describe brevemente tu experiencia, fortalezas y el tipo de oportunidades que buscas."
                                class="w-full resize-y rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">{{ old('professional_summary', auth()->user()?->perfilCandidato?->professional_summary) }}</textarea>
                            @error('professional_summary')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="work_area" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Area laboral
                            </label>
                            <select
                                id="work_area"
                                name="work_area"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona un area</option>
                                <option value="desarrollo_web" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'desarrollo_web')>Desarrollo Web</option>
                                <option value="frontend" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'frontend')>Desarrollo Frontend</option>
                                <option value="backend" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'backend')>Desarrollo Backend</option>
                                <option value="full_stack" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'full_stack')>Desarrollo Full Stack</option>
                                <option value="mobile" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'mobile')>Desarrollo Mobile</option>
                                <option value="desarrollo_software" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'desarrollo_software')>Desarrollo de Software</option>
                                <option value="ia_machine_learning" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'ia_machine_learning')>Inteligencia Artificial / Machine Learning</option>
                                <option value="automatizaciones" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'automatizaciones')>Automatizaciones / No-Code / Low-Code</option>
                                <option value="devops_cloud" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'devops_cloud')>DevOps / Infraestructura / Cloud</option>
                                <option value="bases_datos" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'bases_datos')>Bases de Datos</option>
                                <option value="ciberseguridad" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'ciberseguridad')>Ciberseguridad</option>
                                <option value="qa_testing" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'qa_testing')>QA / Testing</option>
                                <option value="ui_ux" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'ui_ux')>UI/UX Design</option>
                                <option value="producto_digital" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'producto_digital')>Producto Digital / Product Management</option>
                                <option value="soporte_tecnico" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'soporte_tecnico')>Soporte Tecnico / Help Desk</option>
                                <option value="redes_telecom" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'redes_telecom')>Redes / Telecomunicaciones</option>
                                <option value="data_analytics_bi" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'data_analytics_bi')>Data Analytics / BI</option>
                                <option value="data_science" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'data_science')>Data Science</option>
                                <option value="erp_crm" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'erp_crm')>ERP / CRM / Sistemas Empresariales</option>
                                <option value="project_management" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'project_management')>Project Management / Scrum</option>
                                <option value="marketing_tech" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'marketing_tech')>Marketing Tech / SEO / Analytics</option>
                                <option value="ecommerce" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'ecommerce')>E-commerce / Plataformas Digitales</option>
                                <option value="blockchain_web3" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'blockchain_web3')>Blockchain / Web3</option>
                                <option value="game_dev" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'game_dev')>Videojuegos / Game Dev</option>
                                <option value="otro" @selected(old('work_area', auth()->user()?->perfilCandidato?->work_area) === 'otro')>Otro</option>
                            </select>
                            @error('work_area')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="years_experience" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Anos de experiencia
                            </label>
                            <input
                                id="years_experience"
                                name="years_experience"
                                type="number"
                                min="0"
                                max="60"
                                step="1"
                                placeholder="Ej. 3"
                                value="{{ old('years_experience', auth()->user()?->perfilCandidato?->years_experience) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('years_experience')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="education_level" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Nivel de estudios
                            </label>
                            <select
                                id="education_level"
                                name="education_level"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona un nivel</option>
                                <option value="secundaria" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'secundaria')>Secundaria</option>
                                <option value="bachillerato" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'bachillerato')>Bachillerato</option>
                                <option value="tecnico" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'tecnico')>Tecnico</option>
                                <option value="licenciatura" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'licenciatura')>Licenciatura</option>
                                <option value="maestria" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'maestria')>Maestria</option>
                                <option value="doctorado" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'doctorado')>Doctorado</option>
                                <option value="otro" @selected(old('education_level', auth()->user()?->perfilCandidato?->education_level) === 'otro')>Otro</option>
                            </select>
                            @error('education_level')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col-reverse gap-3 border-t border-fondo-secundario/10 pt-5 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <a
                                href="{{ route('candidato.onboarding.fase1') }}"
                                class="inline-flex justify-center rounded-md bg-fondo-campo px-5 py-3 text-sm font-semibold text-fondo-secundario transition hover:bg-fondo-secundario/10">
                                Volver
                            </a>
                            <button
                                type="submit"
                                class="rounded-md bg-primario px-6 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">
                                Continuar a preferencias laborales
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
</body>

</html>
