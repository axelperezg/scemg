<?php

namespace App\Livewire\Institutions;

use App\Models\Institution;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ViewAction;

use function Ramsey\Uuid\v1;

class ListInstitutions extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Institution::query())
            ->columns([
                Tables\Columns\TextColumn::make('sector.acronym')
                ->label('Acronimo')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('name')
                ->label('Sector')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                ->label('Clave de Entidad')
                    ->searchable()
                    ->sortable(),
                
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
                Tables\Filters\SelectFilter::make('sector_id')
                ->relationship('sector', 'acronym') 
                ->preload(),
            ])
            ->actions([
                //
                Action::make('edit')
                    ->url(fn (Institution $record): string => route('institutions.edit-institution', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label('Editar'),
                    ViewAction::make()
                    ->form([
                    TextInput::make('code')
                    ->label('Clave Entidad')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('name')
                    ->label('Nombre')
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
                    ->successRedirectUrl(route('institutions.list-institutions')),
                ]),
            
            ]);
    }

    public function render(): View
    {
        return view('livewire.institutions.list-institutions');
    }
}
