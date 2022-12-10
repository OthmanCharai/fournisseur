<?php

namespace App\Filament\Resources\PurchaseResource\RelationManagers;

use App\Models\Investor;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestorsRelationManager extends RelationManager
{
    protected static string $relationship = 'investors';

    protected static string|null $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('investments.amount')
                ->options(static function (Investor $investor){
                        return Investor::all()->pluck('name','id');
                })
                ->multiple()
                ->required()
                ->columnSpan(2)
                ,

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('purchases.amount'),
                Tables\Columns\TextColumn::make('investments.amount'),


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
