<?php

namespace App\Livewire\Strategies;

use App\Models\Strategy;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditStrategy extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Strategy $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
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
                Forms\Components\TextInput::make('plan_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('subcategory_id')
                    ->required()
                    ->numeric(),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.strategies.edit-strategy');
    }
}
