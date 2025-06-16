<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';
    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\TextInput::make('nama_customer')
                        ->required()
                        ->maxLength(255)
                        ->label('Nama Customer'),
                    Forms\Components\TextInput::make('alamat')
                        ->nullable()
                        ->maxLength(255)
                        ->label('Alamat'),
                    Forms\Components\TextInput::make('telp')
                        ->nullable()
                        ->maxLength(20)
                        ->label('Telepon'),
                    Forms\Components\TextInput::make('fax')
                        ->nullable()
                        ->maxLength(20)
                        ->label('Fax'),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->nullable()
                        ->maxLength(255)
                        ->label('Email'),
                ]
            )->columns([
                'sm' => 1,
                'md' => 2,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    Tables\Columns\TextColumn::make('nama_customer')
                        ->label('Nama Customer')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('alamat')
                        ->label('Alamat')
                        ->limit(50)
                        ->sortable(),
                    Tables\Columns\TextColumn::make('telp')
                        ->label('Telepon')
                        ->limit(20)
                        ->sortable(),
                    Tables\Columns\TextColumn::make('fax')
                        ->label('Fax')
                        ->limit(20)
                        ->sortable(),
                    Tables\Columns\TextColumn::make('email')
                        ->label('Email')
                        ->limit(50)
                        ->sortable(),

                ]
            )
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
