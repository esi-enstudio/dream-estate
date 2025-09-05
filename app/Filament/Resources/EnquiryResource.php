<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnquiryResource\Pages;
use App\Filament\Resources\EnquiryResource\RelationManagers;
use App\Models\Enquiry;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnquiryResource extends Resource
{
    protected static ?string $model = Enquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?int $navigationSort = 4; // সাইডবারে এটি কোথায় দেখাবে

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Enquiry Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->relationship('property', 'title')
                            ->disabled(),
                        Forms\Components\TextInput::make('name')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->rows(5)
                            ->columnSpanFull()
                            ->disabled(),
                    ]),

                Forms\Components\Section::make('Management')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'read' => 'Read',
                                'contacted' => 'Contacted',
                            ])
                            ->required()
                            ->native(false), // সুন্দর UI-এর জন্য

                        Forms\Components\Toggle::make('is_read')
                            ->label('Mark as Read'),

                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Read Timestamp')
                            ->disabled(),
                    ])
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.title')
                    ->label('Property')
                    ->searchable()
                    ->sortable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'read' => 'info',
                        'contacted' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc') // ডিফল্টভাবে নতুনগুলো আগে দেখাবে
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'read' => 'Read',
                        'contacted' => 'Contacted',
                    ]),
                Tables\Filters\SelectFilter::make('property')
                    ->relationship('property', 'title')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\Action::make('markAsContacted')
                    ->label('Mark as Contacted')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Enquiry $record) {
                        $record->update(['status' => 'contacted', 'is_read' => true, 'read_at' => now()]);
                    })
                    ->visible(fn (Enquiry $record): bool => $record->status !== 'contacted'),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Enquiry View পেজের জন্য Infolist
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Enquiry Details')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('property.title'),
                        TextEntry::make('name'),
                        TextEntry::make('email')->copyable(),
                        TextEntry::make('phone')->copyable(),
                        TextEntry::make('message')->columnSpanFull()->markdown(),
                    ]),
                Section::make('Status & Timestamps')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('status')->badge()->color(fn (string $state): string => match ($state) {
                            'pending' => 'warning',
                            'read' => 'info',
                            'contacted' => 'success',
                        }),
                        IconEntry::make('is_read')->boolean(),
                        TextEntry::make('created_at')->dateTime(),
                        TextEntry::make('read_at')->dateTime(),
                    ])
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
            'index' => Pages\ListEnquiries::route('/'),
            'create' => Pages\CreateEnquiry::route('/create'),
            'view' => Pages\ViewEnquiry::route('/{record}'),
            'edit' => Pages\EditEnquiry::route('/{record}/edit'),
        ];
    }

    /**
     * সাইডবারে নতুন Enquiry-এর সংখ্যা দেখানোর জন্য ব্যাজ
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('status', 'pending')->count() > 0 ? 'warning' : 'success';
    }
}
