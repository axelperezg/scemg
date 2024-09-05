<?php

namespace App\Livewire\Plans;

use App\Models\Plan;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables\Actions\Action;

class ListPlans extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Plan::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
                Action::make('edit')
                    ->url(fn (Plan $record): string => route('plans.edit-plans', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label('Editar'),
                    ViewAction::make()
                    ->form([
                        TextInput::make('name')
                        ->label('Nombre del Plan')
                        ->required()
                        ->maxLength(255),
                        // ...
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                    DeleteBulkAction::make()
                    ->successNotificationTitle('Registro eliminado')
                    ->successRedirectUrl(route('plans.list-plans')),
                ]),
            
            ]);
    }


    public function render(): View
    {
        return view('livewire.plans.list-plans');
    }
}
