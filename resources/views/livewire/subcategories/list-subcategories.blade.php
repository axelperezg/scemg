<div>

<div class="flex justify-between items-center p-4 bg-white-100 border-b border-white-200">
    <!-- Texto de encabezado -->
    <h1 class="text-xl font-semibold">Consultar Registro de Subcategorias</h1>

    <!-- Botón para crear un nuevo Registro-->
    <a href="{{ route('subcategories.create-subcategories') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
        Crear Subcategoría
    </a>
</div>

<div>
    {{ $this->table }}
</div>
