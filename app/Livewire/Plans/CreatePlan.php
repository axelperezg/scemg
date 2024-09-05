<?php

namespace App\Livewire\Plans;

use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreatePlan extends Component implements HasForms
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
                    ->label('Nombre del Plan')
                    ->required()
                    ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Plan::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Plan::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.plans.create-plan');
    }
}