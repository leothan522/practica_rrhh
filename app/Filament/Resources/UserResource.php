<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = "Usuarios";
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?int $navigationSort = 2;

    protected static ?string $label = "Usuarios";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos de Usuario')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->hiddenOn('edit'),
                    ]),
                Forms\Components\Section::make('Datos de Ubicación')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('estados_id')
                            ->relationship('estado', 'nombre')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set){
                                $set('municipios_id', null);
                                $set('parroquias_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('municipios_id')
                            ->label('Municipio')
                            //->relationship('municipio', 'nombre')
                            ->options(
                                fn(Forms\Get $get): Collection => Municipio::query()
                                ->where('estados_id', $get('estados_id'))
                                ->pluck('nombre', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Forms\Set $set) => $set('parroquias_id', null))
                            ->required(),
                        Forms\Components\Select::make('parroquias_id')
                            ->label('Parroquia')
                            //->relationship('parroquia', 'nombre')
                            ->options(
                                fn(Forms\Get $get): Collection => Parroquia::query()
                                ->where('municipios_id', $get('municipios_id'))
                                ->pluck('nombre', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado.nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('municipio.nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
