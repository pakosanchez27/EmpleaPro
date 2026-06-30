<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi perfil | EmpleaPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
    $user = auth()->user();
    $profile = $user?->perfilCandidato;
    $initials = collect(preg_split('/\s+/', trim($user?->name ?? 'Candidato')))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
    $avatarUrl = $user?->avatar
        ? (str_starts_with($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar))
        : null;
    $location = collect([$profile?->city, $profile?->state])->filter()->unique()->implode(', ');
    $labels = [
        'desarrollo_web' => 'Desarrollo web',
        'frontend' => 'Frontend',
        'backend' => 'Backend',
        'full_stack' => 'Full Stack',
        'mobile' => 'Desarrollo móvil',
        'desarrollo_software' => 'Software',
        'ia_machine_learning' => 'IA / Machine Learning',
        'automatizaciones' => 'Automatización',
        'devops_cloud' => 'DevOps / Cloud',
        'bases_datos' => 'Bases de datos',
        'ciberseguridad' => 'Ciberseguridad',
        'qa_testing' => 'QA / Testing',
        'ui_ux' => 'UI / UX',
        'data_analytics_bi' => 'Data / BI',
        'data_science' => 'Data Science',
        'presencial' => 'Presencial',
        'remoto' => 'Remoto',
        'hibrido' => 'Híbrido',
    ];
    $profileTags = collect([
        $labels[$profile?->work_area] ?? ($profile?->work_area ? str($profile->work_area)->replace('_', ' ')->title() : null),
        $labels[$profile?->desired_modality] ?? null,
        $profile?->education_level ? str($profile->education_level)->title() : null,
        $profile?->years_experience !== null ? $profile->years_experience . ' años de experiencia' : null,
    ])->filter()->unique()->take(4);
@endphp

<body class="min-h-screen bg-fondo-principal text-fondo-secundario antialiased">
    <header class="sticky top-0 z-50 border-b border-fondo-secundario/10 bg-blanco/95 backdrop-blur">
        <div class="mx-auto flex h-18 w-full max-w-6xl items-center justify-between gap-6 px-4 sm:px-6 lg:px-8">
            <a href="{{ route('candidato.home') }}" class="flex items-center gap-3" aria-label="Ir al inicio de EmpleaPro">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-primario text-blanco shadow-sm">
                    <span class="h-4 w-4 rounded-sm bg-blanco"></span>
                </span>
                <span class="text-xl font-extrabold tracking-tight text-fondo-secundario">Emplea<span class="text-primario">Pro</span></span>
            </a>

            <nav class="hidden items-center gap-1 md:flex" aria-label="Menú principal">
                <a href="{{ route('candidato.home') }}" class="rounded-full bg-primario/10 px-4 py-2 text-sm font-bold text-primario">Mi perfil</a>
                <a href="#vacantes" class="rounded-full px-4 py-2 text-sm font-semibold text-fondo-secundario/65 transition hover:bg-fondo-campo hover:text-primario">Vacantes</a>
                <a href="#postulaciones" class="rounded-full px-4 py-2 text-sm font-semibold text-fondo-secundario/65 transition hover:bg-fondo-campo hover:text-primario">Mis postulaciones</a>
            </nav>

            <div class="flex items-center gap-3">
                <button type="button" class="grid h-10 w-10 place-items-center rounded-full bg-fondo-campo text-fondo-secundario transition hover:text-primario" aria-label="Notificaciones">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9ZM10 21h4" />
                    </svg>
                </button>
                <div class="grid h-10 w-10 place-items-center overflow-hidden rounded-full bg-primario text-xs font-extrabold text-blanco ring-2 ring-primario/15">
                    @if ($avatarUrl)
                        <img src="{{ $avatarUrl }}" alt="" class="h-full w-full object-cover">
                    @else
                        {{ $initials }}
                    @endif
                </div>
                <button type="button" class="grid h-10 w-10 place-items-center rounded-full text-fondo-secundario md:hidden" aria-label="Abrir menú">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <main class="pb-10">
        @if (session('success'))
            <div class="mx-auto w-full max-w-6xl px-4 pt-4 sm:px-6 lg:px-8">
                <div class="rounded-xl bg-primario/10 px-4 py-3 text-sm font-semibold text-primario">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <section id="perfil" class="w-full bg-blanco shadow-sm ring-1 ring-fondo-secundario/10">
            <div class="relative h-44 overflow-hidden bg-fondo-secundario sm:h-52">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_20%,rgba(7,195,115,0.95),transparent_28%),radial-gradient(circle_at_76%_0%,rgba(16,110,204,0.75),transparent_34%),linear-gradient(120deg,#0c6432_0%,#13161c_52%,#0c6432_100%)]"></div>
                <div class="absolute -bottom-24 left-1/3 h-56 w-56 rounded-full bg-verde-claro/20 blur-3xl"></div>
                <div class="relative mx-auto h-full w-full max-w-6xl px-4 sm:px-6 lg:px-8">
                    <button type="button" class="absolute right-4 top-6 rounded-full bg-blanco/95 p-2.5 text-fondo-secundario shadow-sm transition hover:text-primario sm:right-6 lg:right-8" aria-label="Editar portada">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6.5 17.5 10.5M4 20l4.2-.8L19 8.4a2.8 2.8 0 0 0-4-4L4.2 15.2 4 20Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-6xl px-4 pb-6 sm:px-6 sm:pb-8 lg:px-8">
                <div class="absolute -top-16 left-4 sm:-top-20 sm:left-6 lg:left-8">
                    <div class="grid h-32 w-32 place-items-center overflow-hidden rounded-full border-[6px] border-blanco bg-primario text-3xl font-extrabold text-blanco shadow-md sm:h-40 sm:w-40">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="Foto de perfil de {{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <span>{{ $initials }}</span>
                        @endif
                    </div>
                </div>

                <div class="grid gap-8 pt-20 sm:pt-24 lg:grid-cols-[1fr_0.9fr] lg:items-end">
                    <div>
                        <h1 class="text-3xl font-extrabold tracking-tight text-fondo-secundario sm:text-4xl">{{ $user?->name }}</h1>
                        <p class="mt-2 text-lg font-semibold text-primario">{{ $profile?->professional_title ?? 'Completa tu título profesional' }}</p>
                        @if ($location)
                            <p class="mt-1 flex items-center gap-2 text-sm text-fondo-secundario/60">
                                <svg class="h-4 w-4 text-primario" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" /><circle cx="12" cy="10" r="2.5" />
                                </svg>
                                {{ $location }}
                            </p>
                        @endif

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('candidato.onboarding.fase1') }}" class="inline-flex items-center justify-center rounded-full bg-fondo-secundario px-6 py-3 text-sm font-bold text-blanco transition hover:bg-primario focus:outline-none focus:ring-4 focus:ring-primario/20">
                                Editar perfil
                            </a>
                            <button id="open-contact-modal" type="button" class="inline-flex items-center justify-center rounded-full border border-fondo-secundario/20 bg-blanco px-6 py-3 text-sm font-bold text-fondo-secundario transition hover:border-primario hover:text-primario">
                                Datos de contacto
                            </button>
                        </div>
                    </div>

                    <div class="lg:text-right">
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-fondo-secundario/45">Disponibilidad actual</p>
                        <div class="mt-2 inline-flex items-center gap-2 rounded-full bg-verde-claro/12 px-4 py-2 text-sm font-bold text-primario">
                            <span class="h-2.5 w-2.5 rounded-full bg-verde-claro"></span>
                            {{ $profile?->availability ? str($profile->availability)->replace('_', ' ')->title() : 'Por definir' }}
                        </div>

                        @if ($profileTags->isNotEmpty())
                            <p class="mt-6 text-xs font-bold uppercase tracking-[0.18em] text-fondo-secundario/45">Mi perfil</p>
                            <div class="mt-3 flex flex-wrap gap-2 lg:justify-end">
                                @foreach ($profileTags as $tag)
                                    <span class="rounded-full bg-fondo-campo px-4 py-2 text-xs font-bold text-fondo-secundario/75 ring-1 ring-fondo-secundario/5">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 grid gap-3 border-t border-fondo-secundario/10 pt-6 md:grid-cols-3">
                    <a href="{{ route('candidato.onboarding.fase3') }}" class="group flex items-center justify-between rounded-2xl bg-fondo-campo p-5 transition hover:bg-primario/10">
                        <span>
                            <span class="block text-sm font-extrabold text-fondo-secundario">Listo para trabajar</span>
                            <span class="mt-1 block text-xs text-fondo-secundario/55">Actualiza tu disponibilidad.</span>
                        </span>
                        <span class="grid h-9 w-9 place-items-center rounded-full border border-primario text-lg text-primario transition group-hover:bg-primario group-hover:text-blanco">→</span>
                    </a>
                    <a href="{{ route('candidato.onboarding.fase2') }}" class="group flex items-center justify-between rounded-2xl bg-fondo-campo p-5 transition hover:bg-primario/10">
                        <span>
                            <span class="block text-sm font-extrabold text-fondo-secundario">Perfil profesional</span>
                            <span class="mt-1 block text-xs text-fondo-secundario/55">Cuenta mejor lo que sabes hacer.</span>
                        </span>
                        <span class="grid h-9 w-9 place-items-center rounded-full border border-primario text-lg text-primario transition group-hover:bg-primario group-hover:text-blanco">→</span>
                    </a>
                    <a href="{{ route('candidato.onboarding.fase5') }}" class="group flex items-center justify-between rounded-2xl bg-fondo-campo p-5 transition hover:bg-primario/10">
                        <span>
                            <span class="block text-sm font-extrabold text-fondo-secundario">Currículum</span>
                            <span class="mt-1 block text-xs text-fondo-secundario/55">Mantén tu CV siempre actualizado.</span>
                        </span>
                        <span class="grid h-9 w-9 place-items-center rounded-full border border-primario text-lg text-primario transition group-hover:bg-primario group-hover:text-blanco">→</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <div id="contact-modal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="contact-modal-title">
        <button id="contact-modal-backdrop" type="button" class="absolute inset-0 bg-fondo-secundario/70 backdrop-blur-sm" aria-label="Cerrar modal"></button>

        <div class="relative z-10 w-full max-w-lg overflow-hidden rounded-2xl bg-blanco shadow-2xl">
            <div class="flex items-start justify-between border-b border-fondo-secundario/10 px-6 py-5">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-primario">Mi perfil</p>
                    <h2 id="contact-modal-title" class="mt-1 text-2xl font-extrabold text-fondo-secundario">Datos de contacto</h2>
                    <p class="mt-1 text-sm text-fondo-secundario/55">Mantén actualizada la información con la que pueden localizarte.</p>
                </div>
                <button id="close-contact-modal" type="button" class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-fondo-campo text-xl text-fondo-secundario transition hover:text-primario" aria-label="Cerrar modal">×</button>
            </div>

            <form method="POST" action="{{ route('candidato.contacto.update') }}" class="space-y-5 px-6 py-6" novalidate>
                @csrf
                @method('PATCH')

                <div>
                    <label for="contact_email" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Correo electrónico</label>
                    <input id="contact_email" type="email" value="{{ $user?->email }}" disabled
                        class="w-full cursor-not-allowed rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario/55">
                    <p class="mt-1.5 text-xs text-fondo-secundario/45">El correo está vinculado y verificado con tu cuenta.</p>
                </div>

                <div>
                    <label for="contact_phone" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Teléfono</label>
                    <input id="contact_phone" name="contact_phone" type="tel" inputmode="numeric" maxlength="10"
                        value="{{ old('contact_phone', $user?->phone) }}" placeholder="10 dígitos"
                        class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                    @error('contact_phone', 'contacto')
                        <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="contact_city" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Ciudad o municipio</label>
                        <input id="contact_city" name="contact_city" type="text" value="{{ old('contact_city', $profile?->city) }}"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                        @error('contact_city', 'contacto')
                            <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_state" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Estado</label>
                        <input id="contact_state" name="contact_state" type="text" value="{{ old('contact_state', $profile?->state) }}"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                        @error('contact_state', 'contacto')
                            <p class="mt-2 text-xs font-semibold text-red-700">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-fondo-secundario/10 pt-5 sm:flex-row sm:justify-end">
                    <button id="cancel-contact-modal" type="button" class="rounded-full border border-fondo-secundario/15 px-5 py-2.5 text-sm font-bold text-fondo-secundario transition hover:border-primario hover:text-primario">Cancelar</button>
                    <button type="submit" class="rounded-full bg-primario px-6 py-2.5 text-sm font-bold text-blanco transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const contactModal = document.getElementById('contact-modal');
        const openContactModal = document.getElementById('open-contact-modal');
        const closeContactModalButtons = [
            document.getElementById('close-contact-modal'),
            document.getElementById('cancel-contact-modal'),
            document.getElementById('contact-modal-backdrop'),
        ];

        function showContactModal() {
            contactModal.classList.remove('hidden');
            contactModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            document.getElementById('contact_phone').focus();
        }

        function hideContactModal() {
            contactModal.classList.add('hidden');
            contactModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        openContactModal.addEventListener('click', showContactModal);
        closeContactModalButtons.forEach((button) => button.addEventListener('click', hideContactModal));
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !contactModal.classList.contains('hidden')) {
                hideContactModal();
            }
        });

        @if ($errors->contacto->any())
            showContactModal();
        @endif
    </script>
</body>

</html>
