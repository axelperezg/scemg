<?php

namespace App\Livewire\Strategies;

use App\Models\Strategy;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\{Plan, Category, Subcategory};

class CreateStrategy extends Component implements HasForms
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
                Forms\Components\TextInput::make('anio')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('partidaPresupuestal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mision')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('vision')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sector_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('institution_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('objetivoInstitucional')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('objetivoEstrategiaComunicacion')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Select::make('plan_id')
                    ->label('Plan')
                    ->options(Plan::all()->pluck('name', 'id'))
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set) => $set('category_id', null)), // Resetea la categoría cuando cambia el plan
                Forms\Components\Select::make('category_id')
                    ->label('Categoría')
                    ->options(function (callable $get) {
                        $planId = $get('plan_id');
                        if (!$planId) {
                            return [];
                        }
                        return Category::where('plan_id', $planId)->pluck('name', 'id');
                    })
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set) => $set('subcategory_id', null)), // Resetea la subcategoría cuando cambia la categoría
                Forms\Components\Select::make('subcategory_id')
                    ->label('Subcategoría')
                    ->options(function (callable $get) {
                        $categoryId = $get('category_id');
                        if (!$categoryId) {
                            return [];
                        }
                        return Subcategory::where('category_id', $categoryId)->pluck('name', 'id');
                    }),
            ])
            ->statePath('data')
            ->model(Strategy::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Strategy::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.strategies.create-strategy');
    }
}