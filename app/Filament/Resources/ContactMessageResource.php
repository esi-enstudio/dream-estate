<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Site Management';
    protected static ?int $navigationSort = 5;

    /**
     * সাইডবারে নতুন (অপঠিত) মেসেজের সংখ্যা দেখানোর জন্য ব্যাজ
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_read', false)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('is_read', false)->count() > 0 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Status')
                    ->placeholder('All Messages')
                    ->trueLabel('Read Messages')
                    ->falseLabel('Unread Messages'),
            ])
            ->actions([
                // মডালে সম্পূর্ণ মেসেজটি দেখার জন্য ViewAction
                Action::make('view')
                    ->label('View Message')
                    ->icon('heroicon-o-eye')
                    ->infolist([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('phone'),
                        TextEntry::make('subject'),
                        TextEntry::make('message')
                            ->columnSpanFull()
                            ->markdown(),
                        TextEntry::make('created_at')->dateTime(),
                    ])
                    ->action(function (ContactMessage $record) {
                        // ভিউ বাটনে ক্লিক করলেই মেসেজটি 'পঠিত' হিসেবে মার্ক হয়ে যাবে
                        if (!$record->is_read) {
                            $record->update(['is_read' => true]);
                        }
                    })
                    ->modalWidth('3xl'),

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
            'index' => Pages\ListContactMessages::route('/'),
//            'create' => Pages\CreateContactMessage::route('/create'),
//            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
