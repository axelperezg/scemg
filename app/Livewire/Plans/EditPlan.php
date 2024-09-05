<?php

namespace App\Livewire\Plans;

use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditPlan extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Plan $plan;

    public function mount(Plan $plan): void
    {
        $this->form->fill($plan->toArray());  
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Plan::class);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->plan->update($data);

        Notification::make()
        ->title('Registro Editado Exitosamente')
        ->success()
        ->seconds(5)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('plans.list-plans');
    }

    public function render(): View
    {
        return view('livewire.plans.edit-plan');
    }
}
