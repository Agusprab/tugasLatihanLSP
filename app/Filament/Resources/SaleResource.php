<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label('Pilih Customer')
                    ->options(\App\Models\Customer::pluck('nama_customer', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('do_number')
                    ->label('Nomor DO')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([

                        'belum dibayar' => 'Belum Dibayar',
                        'lunas' => 'Lunas',
                    ])
                    ->default('belum dibayar')
                    ->required(),
                Forms\Components\Select::make('transaction_id')
                    ->label('Pilih Transaksi')
                    ->options(\App\Models\Transaction::all()->mapWithKeys(function ($transaction) {
                        return [
                            $transaction->id => $transaction->kode_transaksi . ' - ' .
                                ($transaction->item->nama_item ?? 'Item tidak ada') . ' - Rp ' .
                                number_format($transaction->amount, 0, ',', '.')
                        ];
                    }))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $transaction = \App\Models\Transaction::find($state);
                            if ($transaction) {
                                // Auto fill data dari transaksi yang dipilih
                                $set('amount', $transaction->amount);
                                $set('tanggal_referensi', $transaction->tanggal);
                                $set('keterangan', 'Referensi dari: ' . $transaction->kode_transaksi);
                            }
                        }
                    })
                    ->helperText('Pilih transaksi sebagai referensi'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('do_number')
                    ->label('Nomor DO')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.nama_customer')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction.item.nama_item')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
