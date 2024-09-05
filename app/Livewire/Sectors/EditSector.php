<?php

namespace App\Livewire\Sectors;

use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Filament\Notifications\Notification;

class EditSector extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Sector $sector;

    public function mount(Sector $sector): void
    {
        $this->form->fill($sector->toArray());  
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('acronym')
                    ->required()
                    ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Sector::class);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->sector->update($data);

        Notification::make()
        ->title('Registro Editado Exitosamente')
        ->success()
        ->seconds(5)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('sectors.list-sectors');
        
    }

    public function render(): View
    {
        return view('livewire.sectors.edit-sector');
    }
}

