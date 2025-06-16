<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\Item;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Komponen form
                Forms\Components\Select::make('item_id')
                    ->label('Pilih Item')
                    ->options(\App\Models\Item::all()->pluck('nama_item', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if ($state) {
                            $item = \App\Models\Item::find($state);
                            if ($item) {
                                // Auto fill price dari item yang dipilih
                                $set('price', $item->harga_jual);

                                // Auto calculate amount jika jumlah sudah ada
                                $jumlah = $get('quantity') ?: 1;
                                $set('amount', $jumlah * $item->harga_jual);
                            }
                        } else {
                            // Reset price jika item tidak dipilih
                            $set('price', 0);
                            $set('amount', 0);
                        }
                    }),

                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $harga = $get('price') ?: 0;
                        $jumlah = $state ?: 0;

                        // Auto calculate amount
                        $set('amount', $jumlah * $harga);
                    }),

                Forms\Components\TextInput::make('price')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->disabled() // Tidak bisa diedit manual, diambil dari item
                    ->dehydrated(), // Tetap disimpan ke database

                Forms\Components\TextInput::make('amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
            ])->columns([
                'sm' => 1,
                'md' => 2,
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.nama_item')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Total')
                    ->numeric()
                    ->prefix('Rp')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i:s') // Format Indonesia: dd/mm/yyyy
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
