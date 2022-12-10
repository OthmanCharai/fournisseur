<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Filament\Resources\PurchaseResource\RelationManagers\InvestorsRelationManager;
use App\Filament\Resources\PurchaseResource\RelationManagers\PurchasesRelationManager;
use App\Models\Purchase;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseResource extends Resource
{
    protected static string|null $model = Purchase::class;

    protected static string|null $navigationIcon = 'heroicon-o-collection';

    protected static int|null $navigationSort=4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier','name')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('unite_price')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('supplier.email')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('quantity')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('unite_price')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('created_at')->sortable()->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->sortable()->searchable()
                    ->dateTime(),
            ])
            ->filters([
                //
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
            InvestorsRelationManager::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): string|null
    {
        return Purchase::count();
    }
}
