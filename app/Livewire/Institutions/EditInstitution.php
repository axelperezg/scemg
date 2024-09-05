<?php

namespace App\Livewire\Institutions;

use App\Models\Institution;
use App\Models\Register;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forsms\Get;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditInstitution extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Institution $institution;

    public function mount(Institution $institution): void
    {
        $this->form->fill($institution->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('sector_id')  
            ->relationship('sector', 'acronym') // el sector id, tiene una relacion con el modelo owner y quiero que me traigas el nombre
            ->searchable()
            ->preload()
            ->createOptionForm([
                
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Nombre del Sector'),

                Forms\Components\TextInput::make('acronym')
                ->required()
                ->maxLength(255)
                ->label('Acronimo'),
            ])
            ->required(),
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('code')
                ->required()
                ->maxLength(255),
        ])
            ->statePath('data')
            ->model(Institution::class);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->institution->update($data);

        Notification::make()
        ->title('Registro Editado Exitosamente')
        ->success()
        ->seconds(5)
        ->send();
        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('institutions.list-institutions');
    }

    public function render(): View
    {
        return view('livewire.institutions.edit-institution');
    }
}