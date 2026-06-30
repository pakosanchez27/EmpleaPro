<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CV y finalización | EmpleaPro</title>
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
                    Fase 5: CV y finalización
                </div>
            </header>

            @if (session('success'))
                <div class="mb-6 rounded-md bg-verde-claro/15 px-4 py-3 text-sm font-semibold text-primario">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid overflow-hidden rounded-lg bg-blanco shadow-sm ring-1 ring-fondo-secundario/10 lg:grid-cols-[0.8fr_1.2fr]">
                <aside class="bg-fondo-secundario p-6 text-blanco sm:p-8">
                    <p class="text-sm font-bold text-verde-claro">Perfil de candidato</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-blanco sm:text-4xl">Tu perfil está casi listo</h1>
                    <p class="mt-4 text-sm leading-6 text-blanco/70">
                        Sube tu currículum y elige si las empresas pueden encontrar tu perfil.
                    </p>

                    <div class="mt-8">
                        <div class="h-2 overflow-hidden rounded-full bg-blanco/10">
                            <div class="h-full w-full rounded-full bg-verde-claro"></div>
                        </div>
                        <div class="mt-4 grid grid-cols-5 gap-2 text-center text-xs font-semibold">
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">01</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">02</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">03</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">04</span>
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">05</span>
                        </div>
                    </div>

                    <dl class="mt-8 space-y-4 text-sm">
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Currículum</dt>
                            <dd class="mt-1 text-blanco/65">Adjunta el documento que compartirás con las empresas.</dd>
                        </div>
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Visibilidad</dt>
                            <dd class="mt-1 text-blanco/65">Tú decides si tu perfil aparece en búsquedas.</dd>
                        </div>
                    </dl>
                </aside>

                <section class="p-5 sm:p-8">
                    <div class="mb-6 border-b border-fondo-secundario/10 pb-5">
                        <p class="text-sm font-bold text-primario">Fase 5</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-fondo-secundario">CV y finalización</h2>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('candidato.onboarding.fase5.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div>
                            <label for="cv" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Subir CV
                            </label>
                            <label for="cv"
                                class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-fondo-secundario/15 bg-fondo-campo px-6 py-10 text-center transition hover:border-primario hover:bg-primario/5">
                                <span class="grid h-12 w-12 place-items-center rounded-full bg-primario/10 text-2xl font-bold text-primario">↑</span>
                                <span class="mt-3 text-sm font-bold text-fondo-secundario">Selecciona tu currículum</span>
                                <span class="mt-1 text-xs text-fondo-secundario/55">Archivo PDF, máximo 10 MB</span>
                            </label>
                            <input id="cv" name="cv" type="file" accept="application/pdf,.pdf" class="sr-only">
                            <div id="cv-file-info" class="mt-3 rounded-md bg-primario/10 px-4 py-3 text-xs text-fondo-secundario {{ $profile?->cv_path ? '' : 'hidden' }}">
                                <span class="font-bold text-primario" id="cv-file-name">
                                    {{ $profile?->cv_path ? basename($profile->cv_path) : '' }}
                                </span>
                                <span id="cv-file-size">
                                    @if ($cvSize !== null)
                                        · {{ $cvSize >= 1048576 ? number_format($cvSize / 1048576, 2) . ' MB' : number_format($cvSize / 1024, 2) . ' KB' }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="rounded-lg border border-fondo-secundario/10 bg-fondo-campo p-5">
                            <label class="flex cursor-pointer items-start gap-3">
                                <input name="is_visible" type="hidden" value="0">
                                <input name="is_visible" type="checkbox" value="1" @checked(old('is_visible', $profile?->is_visible ?? true))
                                    class="mt-0.5 h-4 w-4 rounded border-fondo-secundario/20 text-primario focus:ring-primario/20">
                                <span>
                                    <span class="block text-sm font-bold text-fondo-secundario">Hacer visible mi perfil</span>
                                    <span class="mt-1 block text-xs leading-5 text-fondo-secundario/60">
                                        Permite que las empresas encuentren tu perfil y se comuniquen contigo por oportunidades laborales.
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="rounded-lg bg-primario/10 p-5">
                            <p class="text-sm font-bold text-primario">Todo listo para comenzar</p>
                            <p class="mt-1 text-xs leading-5 text-fondo-secundario/65">
                                Al finalizar, tu perfil quedará completado y podrás comenzar a postularte a vacantes.
                            </p>
                        </div>

                        <div class="flex flex-col-reverse gap-3 border-t border-fondo-secundario/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                            <a href="{{ route('candidato.onboarding.fase4') }}"
                                class="inline-flex justify-center rounded-md bg-fondo-campo px-5 py-3 text-sm font-semibold text-fondo-secundario transition hover:bg-fondo-secundario/10">
                                Volver
                            </a>
                            <button type="submit"
                                class="rounded-md bg-primario px-6 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">
                                Finalizar perfil
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
    <script>
        const cvInput = document.getElementById('cv');
        const cvFileInfo = document.getElementById('cv-file-info');
        const cvFileName = document.getElementById('cv-file-name');
        const cvFileSize = document.getElementById('cv-file-size');

        function formatFileSize(bytes) {
            if (bytes >= 1024 * 1024) {
                return `${(bytes / (1024 * 1024)).toFixed(2)} MB`;
            }

            return `${(bytes / 1024).toFixed(2)} KB`;
        }

        cvInput.addEventListener('change', () => {
            const file = cvInput.files[0];

            if (!file) {
                return;
            }

            cvFileName.textContent = file.name;
            cvFileSize.textContent = ` · ${formatFileSize(file.size)}`;
            cvFileInfo.classList.remove('hidden');
        });
    </script>
</body>

</html>
