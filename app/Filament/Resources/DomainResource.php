<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainResource\Pages;
use App\Filament\Resources\DomainResource\RelationManagers;
use App\Models\Domain;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class DomainResource extends Resource
{
    protected static ?string $model = Domain::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    public function rules()
    {
        if ($this->recordId === null) {
            // Validation rules for create operation
            return [
                'name' => 'required|unique',
            ];
        } else {
            // Validation rules for edit operation
            return [
                'name' => [
                    'required',
                    Rule::unique('domains', 'name')->ignore($this->recordId),
                ],
            ];
        }
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->regex('/(?m)http(?:s?):\/\/.*?([^\.\/]+?\.[^\.]+?(?:\.\w{2})?)(?:\/|$)/')
                    ->validationMessages([
                        'regex' => 'Please input valid format: http(s)://abc.xyz',
                ]),
                TextInput::make('type')->label('Type'),
                TextInput::make('status')->label('Status'),
                TextInput::make('http_code')->label('HTTP Code'),
                TextInput::make('http_message')->label('HTTP Message'),
                TextInput::make('description')->label('Description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        if (auth()->check() && auth()->user()->hasRole('admin')) 
        {
            return $table
                ->columns([
                    TextColumn::make('name')->searchable(),
                    TextColumn::make('type'),
                    TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'LIVE' => 'success',
                        'DIE' => 'danger',
                    }),
                    TextColumn::make('description'),
                ])
                ->filters([
                    TrashedFilter::make(),
                ])
                ->actions([
                    Tables\Actions\EditAction::make()->hidden(fn($record) => $record->trashed()),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ViewAction::make()->hidden(fn($record) => $record->trashed())
                    ->label('Detail')
                    ->color('success')
                    ->requiresConfirmation(),
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
                ]);    
        } else {
            return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', auth()->user()->id))
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('type'),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'LIVE' => 'success',
                    'DIE' => 'danger',
                }),
                TextColumn::make('description'),
        ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(fn($record) => $record->trashed()),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ViewAction::make()->hidden(fn($record) => $record->trashed())
                ->label('Detail')
                ->color('success')
                ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
        }
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
            'index' => Pages\ListDomains::route('/'),
            'create' => Pages\CreateDomain::route('/create'),
            'edit' => Pages\EditDomain::route('/{record}/edit'),
        ];
    }
}
