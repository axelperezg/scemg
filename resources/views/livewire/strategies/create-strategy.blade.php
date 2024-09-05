<div>
    <form wire:submit="create">
        {{ $this->form }}

        <br>
        <button type="submit"class=" bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
