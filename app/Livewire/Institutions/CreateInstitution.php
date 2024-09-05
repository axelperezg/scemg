<?php

namespace App\Livewire\Institutions;

use App\Models\Institution;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Illuminate\View\View;


class CreateInstitution extends Component implements HasForms
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
                    ->label('Nombre de la Institución')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Clave de Entidad')
                    ->required()
                    ->maxLength(255),
                
                
            ])
            ->statePath('data')
            ->model(Institution::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        // Verificar si el registro ya existe
        if (Institution::where('name', $data['name'])->exists() || Institution::where('code', $data['code'])->exists() ) {
            // Registro duplicado, mostrar mensaje de error y enviar notificación
            Notification::make()
            ->title('El nombre de la Institucion ya existe')
            ->danger()
            ->seconds(5)
            ->send();
            return;
        }

        $record = Institution::create($data);

        $this->form->model($record)->saveRelationships();
        
        Notification::make()
        ->title('Institución registrada exitosamente')
        ->success()
        ->seconds(5)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('institutions.list-institutions');
    }

    public function render(): View
    {
        return view('livewire.institutions.create-institution');
    }
}