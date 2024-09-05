<?php

namespace App\Livewire;

use App\Models\Register;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Button;
use Livewire\Component;

class ViewRegister extends Component implements HasForms, HasInfolists
{
    
    use InteractsWithInfolists;
    use InteractsWithForms;

    public function mount(Register $register) // Asegúrate de inyectar el modelo Register cuando el componente se monta
    {
        $this->register = $register;
    }

    public function registerInfolist(Infolist $infolist): Infolist
{
    return $infolist
    ->record($this->register)
    ->schema([
        Section::make('Información General de la Clave: ' . $this->register->code)
            ->schema([
                
                TextEntry::make('sector.name')->columnSpan(1),
                TextEntry::make('institution.name')->columnSpan(1),
                TextEntry::make('area')->formatStateUsing(function ($state) {
                    return $state == 1 ? 'Dirección General de Radio Televisión y Cinematografía' : 'Dirección General de Normatividad de Comunicación';
                })
                ->columnSpan(1),
                TextEntry::make('anio')->columnSpan(1),
            ])
            ->columns(2),
        Section::make('Detalles')
            ->schema([
                
                TextEntry::make('campaign')->columnSpan(1)
                    ->label('Campaña'),
                TextEntry::make('version')->columnSpan(1)
                    ->label('Versión'),
                TextEntry::make('coverage')->columnSpan(1)
                    ->label('Cobertura'),
            ])
            ->columns(3),
        Section::make('Documentos de Entrada')
            ->schema([
                TextEntry::make('input_document')->columnSpan(1)
                ->label('Número de Oficio'),
                TextEntry::make('date_document')->columnSpan(1)
                ->label('Fecha de Oficio'),
                
            ])
            ->columns(2),
    ]);
}
    public function render()
    {
        return view('livewire.view-register');
    }
}
