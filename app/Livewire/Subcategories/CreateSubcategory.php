<?php

namespace App\Livewire\Subcategories;

use App\Models\Subcategory;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class CreateSubcategory extends Component implements HasForms
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
            Select::make('category_id')  
            ->relationship('category', 'name') // el sector id, tiene una relacion con el modelo owner y quiero que me traigas el nombre
            ->searchable()
            ->preload()
            ->createOptionForm([
                Select::make('plan_id')  
                ->relationship('plan', 'name') // el sector id, tiene una relacion con el modelo owner y quiero que me traigas el nombre
                ->searchable()
                ->preload(),
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255) 
                ->label('Nombre de Categoria'),
            ])
            ->required(),
            
            Forms\Components\TextInput::make('name')
            ->label('Nombre de la subcategoría')
            ->required()
            ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Subcategory::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Subcategory::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
        ->title('Institución registrada exitosamente')
        ->success()
        ->seconds(5)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('subcategories.list-subcategories');
    }

    public function render(): View
    {
        return view('livewire.subcategories.create-subcategory');
    }
}