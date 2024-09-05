<?php

namespace App\Livewire\Sectors;

use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Notifications\Notification;
use Illuminate\View\View;


class CreateSector extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre del Sector')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('acronym')
                    ->label('Acronimo')
                    ->required()
                    ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Sector::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        // Verificar si el registro ya existe
        if (Sector::where('name', $data['name'])->exists() || Sector::where('acronym', $data['acronym'])->exists()) {
            // Registro duplicado, mostrar mensaje de error y enviar notificación
            Notification::make()
            ->title('El registro esta repetido')
            ->danger()
            ->seconds(5)
            ->send();
            return;
        }

        $record = Sector::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
        ->title('Saved successfully')
        ->success()
        ->seconds(5)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('sectors.list-sectors');

    }

    public function render(): View
    {
        return view('livewire.sectors.create-sector');
    }
}