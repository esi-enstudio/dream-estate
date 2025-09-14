<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HowItWorkResource\Pages;
use App\Filament\Resources\HowItWorkResource\RelationManagers;
use App\Models\HowItWork;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HowItWorkResource extends Resource
{
    protected static ?string $model = HowItWork::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('background_color_class')
                            ->label('Icon Background Color')
                            ->options([
                                'bg-secondary' => 'Secondary (Gray)',
                                'bg-danger' => 'Danger (Red)',
                                'bg-success' => 'Success (Green)',
                                'bg-primary' => 'Primary (Blue)',
                                'bg-warning' => 'Warning (Yellow)',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('icon')
                            ->collection('icons')
                            ->image()->imageEditor()
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('icon')
                    ->collection('icons')
                    ->width(50),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
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
            'index' => Pages\ListHowItWorks::route('/'),
            'create' => Pages\CreateHowItWork::route('/create'),
            'edit' => Pages\EditHowItWork::route('/{record}/edit'),
        ];
    }
}
