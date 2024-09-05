<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" class="h-full">

    <div class="flex min-h-full">
  <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
    <div class="mx-auto w-full max-w-sm lg:w-96">
      <div>
        <img class="h-15 w-auto" src="https://upload.wikimedia.org/wikipedia/commons/3/3d/SEGOB_Logo_2019.svg" alt="Segob">
        <h1 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900 text-center">UNMC | DGNC | DGRTC</h1>
        
        <h4 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900 text-center">Sistema Compartido de Evaluación de Mensajes Gubernamentales</h4>
        
      </div>

      <br>

      <div class="mt-10">
               
        <div>
             {{ $slot }}
        </div>

        <p class="mt-2 text-sm leading-6 text-gray-500">
          ¿No tienes contraseña?
          <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Solicita acceso en la Extensión 15835</a>
        </p>

        <br><br><br><br><br><br><br><br><br><br>

        <div class="mt-10">
          <div class="relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
              <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm font-medium leading-6">
              <span class="bg-white px-6 text-gray-900">Elaboró: MAPG</span>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-1 gap-4">
            <div class="mt-6">
                <p class="text-center text-sm leading-6 text-gray-500">
                &copy; 2024 UNMC | DGNC. Todos los derechos reservados.
                </p>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="relative hidden w-0 flex-1 lg:block">
    <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="">
  </div>
</div>        
    </body>
</html>
