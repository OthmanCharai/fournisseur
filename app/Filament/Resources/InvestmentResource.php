<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestmentResource\Pages;
use App\Filament\Resources\InvestmentResource\RelationManagers;
use App\Models\Investment;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestmentResource extends Resource
{
    protected static string|null $model = Investment::class;

    protected static string|null $navigationIcon = 'heroicon-o-collection';

    protected static string|null $recordTitleAttribute='cycle';

    protected static int|null $navigationSort=2;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('investor_id')
                    ->relationship('investor', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('filing_date')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('cycle')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('investor.name')
                    ->searchable()->sortable(),

                TextColumn::make('investor.email')
                    ->searchable()->sortable(),

                Tables\Columns\TextColumn::make('filing_date')->sortable()->searchable()
                    ->date('Y-m-d'),
                TextColumn::make('due_date')
                    ->dateTime('Y-m-d')

                   ->sortable(),


                Tables\Columns\TextColumn::make('amount')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cycle')->sortable()->searchable(),


            ])
            ->filters([
                //
                Tables\Filters\Filter::make('has investor')
                    ->query(static fn (Builder $query): Builder => $query->whereNotNull('investor_id'))
                    ->label('Has Investor'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvestments::route('/'),
            'create' => Pages\CreateInvestment::route('/create'),
            'edit' => Pages\EditInvestment::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): string|null
    {
        return Investment::count();
    }
}
