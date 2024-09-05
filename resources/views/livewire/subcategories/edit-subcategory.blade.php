<div>
    <form wire:submit="save">
        {{ $this->form }}

        <br>
        <button type="submit"class=" bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            Guardar
        </button>
    </form>

    <x-filament-actions::modals />
</div>
