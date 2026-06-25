<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifica tu correo | EmpleaPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-fondo-principal text-fondo-secundario antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-10">
        <section class="w-full max-w-lg rounded-lg bg-blanco p-8 shadow-sm ring-1 ring-fondo-secundario/10">
            <div class="mb-8 flex items-center justify-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-md bg-primario text-blanco shadow-sm">
                    <span class="h-4 w-4 rounded-sm bg-blanco"></span>
                </span>
                <span class="text-2xl font-extrabold">EmpleaPro</span>
            </div>

            <div class="text-center">
                <span class="mx-auto mb-6 grid h-14 w-14 place-items-center rounded-full bg-verde-claro/15 text-primario">
                    <svg class="h-7 w-7" aria-hidden="true" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7.75A2.75 2.75 0 0 1 6.75 5h10.5A2.75 2.75 0 0 1 20 7.75v8.5A2.75 2.75 0 0 1 17.25 19H6.75A2.75 2.75 0 0 1 4 16.25v-8.5Z" stroke="currentColor" stroke-width="1.8" />
                        <path d="m5 7 7 5 7-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>

                <h1 class="text-fondo-secundario">Cuenta creada correctamente</h1>
                <p class="mt-4 text-sm leading-6 text-fondo-secundario/70">
                    Te enviamos un enlace de verificaci&oacute;n a
                    <span class="font-semibold text-fondo-secundario">{{ auth()->user()?->email }}</span>.
                    Revisa tu bandeja de entrada y confirma tu correo para activar tu cuenta.
                </p>
                <p class="mt-3 text-xs leading-5 text-fondo-secundario/50">
                    Si no ves el correo, revisa la carpeta de spam o promociones.
                </p>
            </div>

        </section>
    </main>
</body>

</html>
