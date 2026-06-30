<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos personales | EmpleaPro</title>
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
                    Fase 1: Datos personales
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
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight text-blanco sm:text-4xl">Completa tus datos personales</h1>
                    <p class="mt-4 text-sm leading-6 text-blanco/70">
                        Esta informacion ayuda a identificar tu perfil antes de avanzar con experiencia, habilidades y preferencias laborales.
                    </p>

                    <div class="mt-8">
                        <div class="h-2 overflow-hidden rounded-full bg-blanco/10">
                            <div class="h-full w-1/4 rounded-full bg-verde-claro"></div>
                        </div>
                        <div class="mt-4 grid grid-cols-4 gap-2 text-center text-xs font-semibold">
                            <span class="rounded-md bg-verde-claro px-2 py-2 text-fondo-secundario">01</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">02</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">03</span>
                            <span class="rounded-md bg-blanco/8 px-2 py-2 text-blanco/55">04</span>
                        </div>
                    </div>

                    <dl class="mt-8 space-y-4 text-sm">
                        <div class="border-l-2 border-verde-claro pl-4">
                            <dt class="font-bold text-blanco">Datos personales</dt>
                            <dd class="mt-1 text-blanco/65">Nombre, contacto y domicilio.</dd>
                        </div>
                        <div class="border-l-2 border-blanco/15 pl-4">
                            <dt class="font-bold text-blanco/55">Siguiente fase</dt>
                            <dd class="mt-1 text-blanco/45">Perfil profesional.</dd>
                        </div>
                    </dl>
                </aside>

                <section class="p-5 sm:p-8">
                    <div class="mb-6 border-b border-fondo-secundario/10 pb-5">
                        <p class="text-sm font-bold text-primario">Fase 1</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-fondo-secundario">Datos personales</h2>
                    </div>

                    <form class="grid gap-5 sm:grid-cols-2" method="POST" action="{{ route('candidato.onboarding.fase1.store') }}" novalidate>
                        @csrf

                        <div>
                            <label for="name" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Nombres
                            </label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                autocomplete="given-name"
                                placeholder="Tus nombres"
                                value="{{ old('name', $firstName) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('name')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Apellidos
                            </label>
                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                autocomplete="family-name"
                                placeholder="Tus apellidos"
                                value="{{ old('last_name', $lastName) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('last_name')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Telefono
                            </label>
                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                inputmode="tel"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                autocomplete="tel"
                                placeholder="Ej. 55 1234 5678"
                                maxlength="10"
                                value="{{ old('phone', auth()->user()?->phone) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('phone')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Fecha de nacimiento
                            </label>
                            <input
                                id="birth_date"
                                name="birth_date"
                                type="date"
                                value="{{ old('birth_date', optional(auth()->user()?->perfilCandidato?->birth_date)->format('Y-m-d')) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('birth_date')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="calle" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Calle
                            </label>
                            <input
                                id="calle"
                                name="calle"
                                type="text"
                                autocomplete="address-line1"
                                placeholder="Nombre de la calle"
                                value="{{ old('calle', auth()->user()?->domicilio?->calle) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('calle')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="numero_exterior" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Numero exterior
                            </label>
                            <input
                                id="numero_exterior"
                                name="numero_exterior"
                                type="text"
                                autocomplete="address-line2"
                                placeholder="Ej. 120"
                                value="{{ old('numero_exterior', auth()->user()?->domicilio?->numero_exterior) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('numero_exterior')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="numero_interior" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Numero interior <span class="font-normal text-fondo-secundario/45">(opcional)</span>
                            </label>
                            <input
                                id="numero_interior"
                                name="numero_interior"
                                type="text"
                                placeholder="Ej. 4B"
                                value="{{ old('numero_interior', auth()->user()?->domicilio?->numero_interior) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('numero_interior')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="codigo_postal" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Codigo postal
                            </label>
                            <input
                                id="codigo_postal"
                                name="codigo_postal"
                                type="text"
                                inputmode="numeric"
                                autocomplete="postal-code"
                                placeholder="Ej. 01000"
                                value="{{ old('codigo_postal', auth()->user()?->domicilio?->codigo_postal) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('codigo_postal')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="delegacion_municipio" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Delegacion o municipio
                            </label>
                            <input
                                id="delegacion_municipio"
                                name="delegacion_municipio"
                                type="text"
                                autocomplete="address-level2"
                                placeholder="Delegacion o municipio"
                                value="{{ old('delegacion_municipio', auth()->user()?->domicilio?->delegacion_municipio) }}"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                            @error('delegacion_municipio')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="estado" class="mb-1.5 block text-xs font-semibold text-fondo-secundario/70">
                                Estado
                            </label>
                            <select
                                id="estado"
                                name="estado"
                                autocomplete="address-level1"
                                class="w-full rounded-md border border-fondo-secundario/10 bg-fondo-campo px-4 py-3 text-sm text-fondo-secundario outline-none transition placeholder:text-fondo-secundario/35 focus:border-primario focus:bg-blanco focus:ring-4 focus:ring-primario/15">
                                <option value="">Selecciona un estado</option>
                                <option value="Aguascalientes" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Aguascalientes')>Aguascalientes</option>
                                <option value="Baja California" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Baja California')>Baja California</option>
                                <option value="Baja California Sur" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Baja California Sur')>Baja California Sur</option>
                                <option value="Campeche" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Campeche')>Campeche</option>
                                <option value="Chiapas" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Chiapas')>Chiapas</option>
                                <option value="Chihuahua" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Chihuahua')>Chihuahua</option>
                                <option value="Ciudad de Mexico" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Ciudad de Mexico')>Ciudad de Mexico</option>
                                <option value="Coahuila" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Coahuila')>Coahuila</option>
                                <option value="Colima" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Colima')>Colima</option>
                                <option value="Durango" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Durango')>Durango</option>
                                <option value="Estado de Mexico" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Estado de Mexico')>Estado de Mexico</option>
                                <option value="Guanajuato" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Guanajuato')>Guanajuato</option>
                                <option value="Guerrero" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Guerrero')>Guerrero</option>
                                <option value="Hidalgo" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Hidalgo')>Hidalgo</option>
                                <option value="Jalisco" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Jalisco')>Jalisco</option>
                                <option value="Michoacan" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Michoacan')>Michoacan</option>
                                <option value="Morelos" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Morelos')>Morelos</option>
                                <option value="Nayarit" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Nayarit')>Nayarit</option>
                                <option value="Nuevo Leon" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Nuevo Leon')>Nuevo Leon</option>
                                <option value="Oaxaca" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Oaxaca')>Oaxaca</option>
                                <option value="Puebla" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Puebla')>Puebla</option>
                                <option value="Queretaro" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Queretaro')>Queretaro</option>
                                <option value="Quintana Roo" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Quintana Roo')>Quintana Roo</option>
                                <option value="San Luis Potosi" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'San Luis Potosi')>San Luis Potosi</option>
                                <option value="Sinaloa" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Sinaloa')>Sinaloa</option>
                                <option value="Sonora" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Sonora')>Sonora</option>
                                <option value="Tabasco" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Tabasco')>Tabasco</option>
                                <option value="Tamaulipas" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Tamaulipas')>Tamaulipas</option>
                                <option value="Tlaxcala" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Tlaxcala')>Tlaxcala</option>
                                <option value="Veracruz" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Veracruz')>Veracruz</option>
                                <option value="Yucatan" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Yucatan')>Yucatan</option>
                                <option value="Zacatecas" @selected(old('estado', auth()->user()?->domicilio?->estado) === 'Zacatecas')>Zacatecas</option>
                            </select>
                            @error('estado')
                                <p class="mt-2 text-xs text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col-reverse gap-3 border-t border-fondo-secundario/10 pt-5 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs leading-5 text-fondo-secundario/50">
                                Tus datos se guardaran en tu perfil de candidato.
                            </p>
                            <button
                                type="submit"
                                class="rounded-md bg-primario px-6 py-3 text-sm font-semibold text-blanco shadow-sm transition hover:bg-verde-claro hover:text-fondo-secundario focus:outline-none focus:ring-4 focus:ring-primario/20">
                                Continuar a perfil profesional
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
</body>

</html>
