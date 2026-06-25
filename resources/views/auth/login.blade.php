<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EmpleaPro Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-fondo-principal text-fondo-secundario antialiased">
    <main class="grid min-h-screen p-3 lg:grid-cols-[0.9fr_1.1fr]">
        <section class="relative hidden overflow-hidden rounded-lg bg-fondo-secundario lg:block">
            <img src="{{ asset('img/register-hero.jpg') }}" alt="Edificio corporativo moderno"
                class="absolute inset-0 h-full w-full object-cover">
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
                        Continua tu perfil justo donde lo dejaste.
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
                    <h1 class="text-fondo-secundario">Inicia sesion</h1>
                    <p class="mt-3 text-sm text-fondo-secundario/65">
                        Entra a tu cuenta para continuar tu perfil profesional.
                    </p>
                </div>

                <form class="space-y-4" method="POST" action="{{ route('login.store') }}" novalidate>
                    @csrf

                    <div>
                        <label for="email" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                            Correo electronico
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            placeholder="tu@email.com"
                            value="{{ old('email') }}"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                        @error('email')
                            <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                            Contrasena
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="********"
                            class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                        @error('password')
                            <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <label class="flex items-center gap-2 text-sm text-fondo-secundario/65">
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="h-4 w-4 rounded border-fondo-secundario/20 text-primario focus:ring-primario">
                            Recordarme
                        </label>
                        <a href="{{ route('register') }}" class="text-sm font-semibold text-azul hover:text-primario">
                            Crear cuenta
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-md bg-primario px-5 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">
                        Iniciar sesion
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>
