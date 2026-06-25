<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EmpleaPro Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-fondo-principal text-fondo-secundario antialiased">
    <main class="grid min-h-screen p-3 lg:grid-cols-[0.9fr_1.1fr]">
        <section class="relative hidden overflow-hidden rounded-lg bg-fondo-secundario lg:block">
            <img
                src="{{ asset('img/register-hero.jpg') }}"
                alt="Edificio corporativo moderno"
                class="absolute inset-0 h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-fondo-secundario/20 via-fondo-secundario/20 to-fondo-secundario/90"></div>

            <div class="relative z-10 flex h-full flex-col justify-between p-8 text-blanco">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-md bg-blanco text-primario shadow-sm">
                        <span class="h-4 w-4 rounded-sm bg-primario"></span>
                    </span>
                    <span class="text-xl font-extrabold leading-none">EmpleaPro</span>
                </a>

                <div class="max-w-md">
                    <p class="mb-6 text-4xl font-extrabold leading-tight">
                        "Conecta talento con empresas listas para crecer."
                    </p>
                    <div class="border-l-4 border-verde-claro pl-4">
                        <p class="font-bold">EmpleaPro</p>
                        <p class="text-sm text-blanco/75">Plataforma de reclutamiento profesional</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex items-center justify-center px-4 py-10 sm:px-8">
            <div class="w-full max-w-md">
                <div class="mb-10 flex items-center justify-center gap-3 lg:hidden">
                    <span class="grid h-10 w-10 place-items-center rounded-md bg-primario text-blanco shadow-sm">
                        <span class="h-4 w-4 rounded-sm bg-blanco"></span>
                    </span>
                    <span class="text-2xl font-extrabold">EmpleaPro</span>
                </div>

                <div class="mb-8 text-center">
                    <h1 class="text-fondo-secundario">Crea tu cuenta</h1>
                    <p class="mt-3 text-sm text-fondo-secundario/65">
                        Encuentra oportunidades, publica vacantes y administra tu perfil profesional.
                    </p>
                </div>

                <form class="space-y-4" method="POST" action="#">
                    @csrf

                    <div>
                        <label for="name" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Nombre completo</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            autocomplete="name"
                            placeholder="Tu nombre"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15"
                        >
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Correo electronico</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            placeholder="tu@email.com"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15"
                        >
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">Contrasena</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15"
                        >
                    </div>

                    <div class="flex items-center justify-between gap-4 pt-1">
                        <label class="flex items-center gap-2 text-sm text-fondo-secundario/65">
                            <input type="checkbox" class="h-4 w-4 rounded border-fondo-secundario/20 text-primario focus:ring-primario">
                            Acepto los terminos
                        </label>
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-azul hover:text-primario">Ya tengo cuenta</a>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-md bg-primario px-5 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20"
                    >
                        Registrarme
                    </button>
                </form>

                <div class="my-6 flex items-center gap-4">
                    <span class="h-px flex-1 bg-fondo-secundario/10"></span>
                    <span class="text-xs font-semibold text-fondo-secundario/45">O</span>
                    <span class="h-px flex-1 bg-fondo-secundario/10"></span>
                </div>

                <button
                    type="button"
                    class="flex w-full items-center justify-center gap-3 rounded-md bg-blanco px-5 py-3 text-sm font-semibold text-fondo-secundario shadow-sm ring-1 ring-fondo-secundario/10 transition hover:ring-primario/30"
                >
                    <img class="w-6" src="{{ asset('img/google.svg') }}" alt=" logo de google">
                    Continuar con Google
                </button>

                <p class="mt-8 text-center text-xs text-fondo-secundario/50">
                    Al continuar, aceptas las politicas de EmpleaPro.
                </p>
            </div>
        </section>
    </main>
</body>
</html>
