<?php

namespace App\Livewire\Subcategories;

use App\Models\Subcategory;
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

class ListSubcategories extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Subcategory::query())
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                ->label('Categoría')
                ->searchable()
                ->sortable(),
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
                    ->url(fn (Subcategory $record): string => route('subcategories.edit-subcategories', $record))
                    ->icon('heroicon-o-pencil-square')
                    ->label('Editar'),
                    ViewAction::make()
                    ->form([
                    TextInput::make('name')
                    ->label('Nombre de la Subcategoría')
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
                    ->successRedirectUrl(route('subcategories.list-subcategories')),
                ]),
            
            ]);
    }

    public function render(): View
    {
        return view('livewire.subcategories.list-subcategories');
    }
}
