<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IdentitasResource\Pages;
use App\Filament\Resources\IdentitasResource\RelationManagers;
use App\Models\Identitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IdentitasResource extends Resource
{
    protected static ?string $model = Identitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_identitas')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Identitas'),
                Forms\Components\TextInput::make('badan_hukum')
                    ->required()
                    ->maxLength(255)
                    ->label('Badan Hukum'),
                Forms\Components\TextInput::make('npwp')
                    ->required()
                    ->maxLength(20)
                    ->label('NPWP'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Email'),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->nullable()
                    ->maxLength(255)
                    ->label('URL'),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->maxLength(500)
                    ->label('Alamat'),
                Forms\Components\TextInput::make('telp')
                    ->nullable()
                    ->maxLength(20)
                    ->label('Telepon'),
                Forms\Components\TextInput::make('fax')
                    ->nullable()
                    ->maxLength(20)
                    ->label('Fax'),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->directory('identitas_foto')
                    ->image()
                    ->unique() // Membuat nama file unik
                    ->visibility('public')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_identitas')
                    ->label('Nama Identitas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('badan_hukum')
                    ->label('Badan Hukum')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('npwp')
                    ->label('NPWP')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListIdentitas::route('/'),
            'create' => Pages\CreateIdentitas::route('/create'),
            'edit' => Pages\EditIdentitas::route('/{record}/edit'),
        ];
    }
}
