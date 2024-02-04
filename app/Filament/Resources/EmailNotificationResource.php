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
    //protected static bool $shouldRegisterNavigation = false;
    public function __construct()
    {
        

    }


    public static function form(Form $form): Form
    {
        $this->$shouldRegisterNavigation = true;
        var_dump(auth()); die();
        return $form
            ->schema([
                TextInput::make('email')->required(),
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
}
