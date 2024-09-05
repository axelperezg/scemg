<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Illuminate\View\View;

class CreateCategory extends Component implements HasForms
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
                Select::make('plan_id')  
                ->relationship('plan', 'name') // el sector id, tiene una relacion con el modelo owner y quiero que me traigas el nombre
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255) 
                    ->label('Nombre del Plan'),
                ])
                ->required(),
            
                Forms\Components\TextInput::make('name')
                ->label('Nombre de la Categoría')
                ->required()
                ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Category::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Category::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
        ->title('Categoría registrada exitosamente')
        ->success()
        ->seconds(5)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('categories.list-categories');

    }

    public function render(): View
    {
        return view('livewire.categories.create-category');
    }
}