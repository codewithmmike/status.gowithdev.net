<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmailNotificationResource\Pages;
use App\Filament\Resources\EmailNotificationResource\RelationManagers;
use App\Models\EmailNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Navigation\NavigationItem;

class EmailNotificationResource extends Resource
{
    protected static ?string $model = EmailNotification::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                ->required()
                ->unique(ignoreRecord: true)
                ->regex('/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9_-]+)/')
                ->validationMessages([
                    'regex' => 'Please input valid format: abc@.xyz.xml',
                ]),
                TextInput::make('status'),
                TextInput::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->searchable(),
                TextColumn::make('status'),
                TextColumn::make('description'),
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
            'index' => Pages\ListEmailNotifications::route('/'),
            'create' => Pages\CreateEmailNotification::route('/create'),
            'edit' => Pages\EditEmailNotification::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return (auth()->check() && auth()->user()->hasRole('admin')) || auth()->user()->email =='code@gowithdev.com';
    }
}
