<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
                
                    <h3 class="text-l font-semibold">Bienvenido al Sistema Compartido de Evaluación de Mensajes Gubernamentales</h3>
                    
                    @role('Administrador')
                    <br>
                    <h1 class="text-xl font-semibold">Sesión iniciada con el Usuario: {{ Auth::user()->name }}</h1>
                    <br>
                    <h1 class="text-xl font-semibold">Rol: Administrador</h1>
                    <br>
                    @include('widgets.stats-overview', ['totalSectors' => $totalSectors, 'totalInstitutions' => $totalInstitutions])
                    @endrole
                    @role('Operador')
                    <br>
                    <h1 class="text-xl font-semibold">Sesión iniciada con el Usuario: {{ Auth::user()->name }}</h1>
                    <br>
                    <h1 class="text-xl font-semibold">Rol: Operador</h1>
                    @endrole
                    </div>

                     
                
        </div>
    </div>
</x-app-layout>
