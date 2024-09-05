<?php

namespace App\Livewire\Strategies;

use App\Models\Strategy;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListStrategies extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Strategy::query())
            ->columns([
                Tables\Columns\TextColumn::make('anio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('partidaPresupuestal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mision')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vision')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sector_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('institution_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('objetivoInstitucional')
                    ->searchable(),
                Tables\Columns\TextColumn::make('objetivoEstrategiaComunicacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subcategory_id')
                    ->numeric()
                    ->sortable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.strategies.list-strategies');
    }
}
