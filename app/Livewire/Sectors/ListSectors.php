<?php

namespace App\Livewire\Sectors;

use App\Models\Sector;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ViewAction;



class ListSectors extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Sector::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Nombre de Sector')
                    ->searchable(),
                Tables\Columns\TextColumn::make('acronym')
                ->label('Acronimo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Ultima Modificación')
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
                    ->url(fn (Sector $record): string => route('sectors.edit-sector', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label('Editar'),
                ViewAction::make()
                    ->form([
                    TextInput::make('name')
                    ->label('Nombre de Sector')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('acronym')
                    ->label('Acronimo')
                    ->required()
                    ->maxLength(255),
                        // ...
                    ]),
            ])
            
            ->actions([
                //
                Action::make('edit')
                    ->url(fn (Sector $record): string => route('sectors.edit-sector', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label('Editar'),
                ViewAction::make()
                    ->form([
                        TextInput::make('name')
                        ->label('Nombre del Sector')
                        ->required()
                        ->maxLength(255),
                        TextInput::make('acronym')
                        ->label('Acronimo')
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
                    ->successRedirectUrl(route('sectors.list-sectors')),
                ]),
            
            ]);
    }

    public function render(): View
    {
        return view('livewire.sectors.list-sectors');
    }
}