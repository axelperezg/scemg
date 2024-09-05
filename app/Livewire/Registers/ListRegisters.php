<?php

namespace App\Livewire\Registers;

use App\Models\Register;
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

class ListRegisters extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Register::query())
            ->columns([
                Tables\Columns\TextColumn::make('code')
                ->label('Clave de campaña')    
                ->searchable()
                ->sortable(),
                
                Tables\Columns\TextColumn::make('area')
                ->label('Unidad Administrativa')  
                ->formatStateUsing(function ($state) {
                        return $state == 1 ? 'DGRTC' : 'DGNC';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('sector.acronym')
                ->label('Sector')  
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('institution.name')
                ->label('Entidad')
                ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                ->label('Tipo de difusión')  
                ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('media')
                ->label('Modalidad')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('campaign')
                ->label('Campaña')  
                ->searchable(),
                Tables\Columns\TextColumn::make('version')
                ->label('Versión')      
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('coverage')
                ->label('Cobertura')  
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('input_document')
                ->label('Oficio de Entrada')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_document')
                ->label('Fecha de Oficio')  
                ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                ->label('Fecha de Creación')      
                ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Ultima Modificación')  ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                //Tables\Columns\TextColumn::make('date_of_register')
                //->label('Fecha de registro')  
                  //  ->date()
                  //  ->sortable()
                  //  ->toggleable(isToggledHiddenByDefault: true),
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
                    ->url(fn (Register $record): string => route('registers.edit-register', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label('Editar'),
                Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->label('Info')
                    ->url(fn (Register $record) => route('view-register', $record))
                    ->openUrlInNewTab(),
                Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->label('Pdf')
                    ->url(fn (Register $record) => route('browserpdf', $record))
                    ->openUrlInNewTab(),
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalDescription('¿Estás seguro de que deseas eliminar este Sector?')
                    ->action(function (Register $record) {
                        $record->delete();
                    })
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
        return view('livewire.registers.list-registers');
    }
}
