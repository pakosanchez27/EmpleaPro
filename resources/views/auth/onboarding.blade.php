<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido | EmpleaPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-fondo-principal text-fondo-secundario antialiased">
    <main class="min-h-screen px-4 py-8 sm:px-8">
        <section class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-6xl flex-col">
            <header class="flex items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-md bg-primario text-blanco shadow-sm">
                        <span class="h-4 w-4 rounded-sm bg-blanco"></span>
                    </span>
                    <span class="text-2xl font-extrabold">EmpleaPro</span>
                </a>

            </header>

            <div class="grid flex-1 items-center gap-10 py-12 lg:grid-cols-[1fr_0.9fr]">
                <section>
                    <span class="mb-5 inline-flex rounded-full bg-verde-claro/15 px-4 py-2 text-sm font-semibold text-primario">
                        Cuenta creada correctamente
                    </span>

                    <h1 class="max-w-3xl text-fondo-secundario">
                        Hola {{ auth()->user()?->name }}, prepara tu perfil profesional
                    </h1>

                    <p class="mt-5 max-w-2xl text-base leading-7 text-fondo-secundario/70">
                        Tu cuenta ya existe. El siguiente paso es verificar tu correo y completar tu informacion para que puedas postularte con un perfil mas fuerte.
                    </p>

                    <div class="mt-8 rounded-lg bg-blanco p-5 shadow-sm ring-1 ring-fondo-secundario/10">
                        <div class="flex gap-4">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-md bg-primario text-blanco">
                                <svg class="h-6 w-6" aria-hidden="true" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 7.75A2.75 2.75 0 0 1 6.75 5h10.5A2.75 2.75 0 0 1 20 7.75v8.5A2.75 2.75 0 0 1 17.25 19H6.75A2.75 2.75 0 0 1 4 16.25v-8.5Z" stroke="currentColor" stroke-width="1.8" />
                                    <path d="m5 7 7 5 7-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div>
                                <h2 class="text-xl font-bold leading-tight">Verifica tu email</h2>
                                <p class="mt-2 text-sm leading-6 text-fondo-secundario/65">
                                    Enviamos un enlace a <span class="font-semibold text-fondo-secundario">{{ auth()->user()?->email }}</span>. Revisa tu bandeja de entrada para activar tu cuenta.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <aside class="rounded-lg bg-fondo-secundario p-6 text-blanco shadow-sm">
                    <h2 class="text-2xl font-bold">Primeros pasos</h2>

                    <div class="mt-6 space-y-4">
                        <div class="rounded-md bg-blanco/8 p-4 ring-1 ring-blanco/10">
                            <p class="text-sm font-semibold text-verde-claro">01</p>
                            <h3 class="mt-2 text-lg font-bold">Confirma tu correo</h3>
                            <p class="mt-2 text-sm leading-6 text-blanco/70">Necesitamos validar que el email pertenece a ti.</p>
                        </div>

                        <div class="rounded-md bg-blanco/8 p-4 ring-1 ring-blanco/10">
                            <p class="text-sm font-semibold text-verde-claro">02</p>
                            <h3 class="mt-2 text-lg font-bold">Completa tus datos</h3>
                            <p class="mt-2 text-sm leading-6 text-blanco/70">Agrega experiencia, habilidades y datos de contacto.</p>
                        </div>

                        <div class="rounded-md bg-blanco/8 p-4 ring-1 ring-blanco/10">
                            <p class="text-sm font-semibold text-verde-claro">03</p>
                            <h3 class="mt-2 text-lg font-bold">Explora vacantes</h3>
                            <p class="mt-2 text-sm leading-6 text-blanco/70">Encuentra oportunidades alineadas con tu perfil.</p>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</body>

</html>
