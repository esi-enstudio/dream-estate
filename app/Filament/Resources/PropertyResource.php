<?php

namespace App\Filament\Resources;

use App\Models\District;
use App\Models\Union;
use App\Models\Upazila;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables;
use App\Models\Property;
use Filament\Forms\Form;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PropertyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\PropertyResource\RelationManagers;
use Illuminate\Support\Collection;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-s-home-modern';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'My Properties';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(3)
                    ->schema([
                        // --- Main Column ---
                        Grid::make()
                            ->columnSpan(2)
                            ->schema([
                                Section::make('মূল তথ্য (Core Information)')
                                    ->schema([
                                        TextInput::make('property_code')
                                            ->label('প্রপার্টি কোড')
                                            ->disabled() // ইউজার এটি পরিবর্তন করতে পারবে না
                                            ->hiddenOn('create'), // নতুন প্রপার্টি তৈরির সময় এটি হাইড থাকবে

                                        TextInput::make('title')
                                            ->label('বাসার শিরোনাম')
                                            ->required()
                                            ->maxLength(255),

                                        RichEditor::make('description')
                                            ->label('বিস্তারিত বর্ণনা')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('মূল্য এবং প্রাপ্যতা (Pricing & Availability)')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('rent_price')
                                                ->label('মাসিক ভাড়া')
                                                ->required()
                                                ->numeric()
                                                ->prefix('৳'),

                                            TextInput::make('service_charge')
                                                ->label('সার্ভিস চার্জ')
                                                ->numeric()
                                                ->default(0)
                                                ->prefix('৳'),

                                            TextInput::make('security_deposit')
                                                ->label('সিকিউরিটি ডিপোজিট')
                                                ->numeric()
                                                ->default(0)
                                                ->prefix('৳'),

                                            DatePicker::make('available_from')
                                                ->label('কবে থেকে পাওয়া যাবে')
                                                ->required(),
                                        ]),
                                    ]),

                                Section::make('বাসার স্পেসিফিকেশন (Property Specifications)')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            Select::make('property_type')
                                                ->label('প্রপার্টির ধরন')
                                                ->options([
                                                    'apartment' => 'Apartment / Flat (এপার্টমেন্ট / ফ্ল্যাট)',
                                                    'duplex' => 'Duplex (ডুপ্লেক্স)',
                                                    'tin_shed' => 'Tin shed (টিন শেড)',
                                                    'semi_ripe' => 'Semi-ripe (আধা পাকা)',
                                                    'room' => 'Room (রুম)',
                                                    'commercial_space' => 'Commercial Space (কমার্শিয়াল স্পেস)',
                                                ])
                                                ->required() // এটি খুবই গুরুত্বপূর্ণ, কারণ আপনার কলামটি NOT NULL
                                                ->searchable(),

                                             Select::make('bedrooms')
                                                ->label('বেডরুম')
                                                ->options(array_combine(range(0, 10), range(0, 10))) // 0 থেকে 10 পর্যন্ত অপশন
                                                ->required(),

                                            Select::make('bathrooms')
                                                ->label('বাথরুম')
                                                ->options(array_combine(range(0, 10), range(0, 10)))
                                                ->required(),

                                            Select::make('balconies')
                                                ->label('বারান্দা')
                                                ->options(array_combine(range(0, 10), range(0, 10)))
                                                ->required(),

                                            TextInput::make('size_sqft')
                                                ->label('আকার (স্কয়ার ফিট)')
                                                ->required()
                                                ->numeric(),

                                            TextInput::make('floor_level')
                                                ->label('ফ্লোর লেভেল')
                                                ->maxLength(255),

                                            Select::make('facing_direction')
                                                ->label('কোনমুখী ফ্ল্যাট')
                                                ->options([
                                                    'south' => 'দক্ষিণ',
                                                    'north' => 'উত্তর',
                                                    'east' => 'পূর্ব',
                                                    'west' => 'পশ্চিম',
                                                    'south-east' => 'দক্ষিণ-পূর্ব',
                                                    'north-east' => 'উত্তর-পূর্ব',
                                                ]),

                                            TextInput::make('year_built')
                                                ->label('নির্মাণ সাল')
                                                ->numeric()->maxValue(date('Y')),
                                        ])
                                    ]),

                                Section::make('নিয়ম (Rules)')
                                    ->schema([
                                        RichEditor::make('house_rules')
                                            ->label('বাসার নিয়মাবলী')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // --- Sidebar Column ---
                        Grid::make()
                            ->columnSpan(1)
                            ->schema([
                                Section::make('স্ট্যাটাস ও ভিজিবিলিটি')
                                    ->schema([
                                        Select::make('status')
                                            ->label('স্ট্যাটাস')
                                            ->options([
                                                'pending' => 'বিচারাধীন (Pending)',
                                                'active' => 'সক্রিয় (Active)',
                                                'rented' => 'ভাড়া হয়ে গেছে (Rented)',
                                                'inactive' => 'নিষ্ক্রিয় (Inactive)',
                                            ])
                                            ->default('pending')
                                            ->required(),

                                        Select::make('is_negotiable')
                                            ->label('মূল্য আলোচনা সাপেক্ষ')
                                            ->options([
                                                'negotiable' => 'আলোচনা সাপেক্ষে (Negotiable)',
                                                'fixed' => 'অপরিবর্তনীয় (Fixed)',
                                            ])
                                            ->default('fixed')
                                            ->required(),

                                        Toggle::make('is_featured')
                                            ->label('ফিচার্ড হিসেবে দেখান')
                                            ->helperText('ফিচার্ড বাসাগুলো হোমপেজে প্রাধান্য পাবে।'),

                                        Toggle::make('is_verified')
                                            ->label('ভেরিফাইড')
                                            ->helperText('এই বাসাটি প্ল্যাটফর্ম দ্বারা যাচাইকৃত।'),
                                    ]),

                                Section::make('অবস্থান (Location)')
                                    ->schema([
                                        Select::make('division_id')
                                            ->label('বিভাগ')
                                            ->required()
                                            ->relationship('division', 'bn_name')
                                            ->helperText('প্রপার্টিটি কোন বিভাগে অবস্থিত তা নির্বাচন করুন।')
                                            ->searchable()
                                            ->preload()
                                            ->live()
                                            ->afterStateUpdated(fn (Set $set) => $set('district_id', null)),

                                        Select::make('district_id')
                                            ->label('জেলা')
                                            ->options(fn (Get $get): Collection => District::query()
                                                ->where('division_id', $get('division_id'))
                                                ->pluck('bn_name', 'id'))
                                            ->getOptionLabelUsing(fn ($value): ?string => District::find($value)?->bn_name)
                                            ->searchable()->live()->preload()
                                            ->afterStateUpdated(fn (Set $set) => $set('upazila_id', null))
                                            ->helperText('প্রপার্টিটি কোন জেলায় অবস্থিত তা নির্বাচন করুন।')
                                            ->required(),

                                        Select::make('upazila_id')
                                            ->label('উপজেলা')
                                            ->options(fn (Get $get): Collection => Upazila::query()
                                                ->where('district_id', $get('district_id'))
                                                ->pluck('bn_name', 'id'))
                                            // --- এখানে getOptionLabel() যোগ করা হয়েছে ---
                                            ->getOptionLabelUsing(fn ($value): ?string => Upazila::find($value)?->bn_name)
                                            ->searchable()->live()->preload()
                                            ->afterStateUpdated(fn (Set $set) => $set('union_id', null))
                                            ->helperText('প্রপার্টিটি কোন উপজেলায় অবস্থিত তা নির্বাচন করুন।')
                                            ->required(),

                                        Select::make('union_id')
                                            ->label('ইউনিয়ন')
                                            ->helperText('প্রপার্টিটি কোন ইউনিয়নে অবস্থিত তা নির্বাচন করুন (যদি থাকে)।')
                                            ->options(fn (Get $get): Collection => Union::query()
                                                ->where('upazila_id', $get('upazila_id'))
                                                ->pluck('bn_name', 'id'))
                                            ->getOptionLabelUsing(fn ($value): ?string => Union::find($value)?->bn_name)
                                            ->searchable()
                                            ->preload()
                                            ->nullable(),
                                        TextInput::make('address_street')->label('রাস্তার ঠিকানা')->required(),
                                        TextInput::make('address_area')->label('এলাকা')->helperText('(যেমন: চন্ডিবেড় মধ্যপাড়া, ভৈরবপুর উত্তরপাড়া)')->required(),
                                        TextInput::make('address_zipcode')->label('জিপ কোড'),
                                        TextInput::make('google_maps_location_link')->label('গুগল ম্যাপস লিংক')->url(),
                                    ]),

                                Section::make('ছবি ও ভিডিও (Media)')
                                    ->schema([
                                        // --- ফিচার্ড বা প্রধান ছবির জন্য ---
                                        SpatieMediaLibraryFileUpload::make('featured_image')
                                            ->label('ফিচার্ড বা প্রধান ছবি (থাম্বনেইল)')
                                            ->collection('featured_image') // <-- ডেডিকেটেড কালেকশন
                                            ->multiple(false) // <-- একটি মাত্র ছবি আপলোড করা যাবে
                                            ->required() // <-- এই ফিল্ডটি বাধ্যতামূলক
                                            ->image() // <-- শুধুমাত্র ইমেজ ফাইল গ্রহণ করবে

                                            // --- Validation ---
                                            ->maxSize(2048) // সর্বোচ্চ সাইজ ২ মেগাবাইট (2048 کیلوبাইট)
                                            ->rules(['image', 'max:2048']) // সার্ভার-সাইড ভ্যালিডেশন

                                            // --- অন্যান্য ইউজফুল মেথড ---
                                            ->imageCropAspectRatio('16:9') // এডিটরে ক্রপ করার জন্য ডিফল্ট অনুপাত
                                            ->imageResizeMode('cover') // ছবির আকার পরিবর্তনের মোড
                                            ->panelLayout('compact') // আপলোড UI-এর ডিজাইন
                                            ->helperText('এটি আপনার প্রপার্টির প্রধান ছবি হিসেবে ওয়েবসাইটে দেখানো হবে। সাইজ ৮৩২x৪৭২ পিক্সেল হলে সবচেয়ে ভালো দেখাবে।'),

                                        // --- গ্যালারির ছবির জন্য ---
                                        SpatieMediaLibraryFileUpload::make('gallery_images')
                                            ->label('গ্যালারির জন্য অতিরিক্ত ছবি')
                                            ->collection('gallery') // <-- গ্যালারির জন্য আলাদা কালেকশন
                                            ->multiple()
                                            ->reorderable()
                                            ->image()
                                            ->maxSize(2048)
                                            ->maxFiles(10) // সর্বোচ্চ ১০টি ছবি আপলোড করা যাবে
                                            ->panelLayout('compact')
                                            ->helperText('এখানে একাধিক ছবি যোগ করতে পারেন।'),

                                        TextInput::make('video_url')
                                            ->label('ইউটিউব ভিডিও লিংক')
                                            ->url()
                                            ->maxLength(255)
                                    ]),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image_thumbnail')
                    ->label('থাম্বনেইল')
                    ->collection('featured_image') // <-- সঠিক কালেকশন থেকে ছবি আনবে
                    ->conversion('thumbnail') // <-- আমাদের তৈরি করা কনভার্সন ব্যবহার করবে
                    ->defaultImageUrl(url('/assets/img/property/placeholder.jpg')), // যদি ছবি না থাকে, একটি ডিফল্ট ছবি দেখাবে

                TextColumn::make('title')
                    ->label('শিরোনাম')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('মালিক')
                    ->sortable(),

                TextColumn::make('rent_price')
                    ->label('ভাড়া')
                    ->money('bdt') // BDT কারেন্সি ফরম্যাট
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label('ফিচার্ড')
                    ->boolean(),

                IconColumn::make('is_verified')
                    ->label('ভেরিফাইড')
                    ->boolean(),

                TextColumn::make('status')
                    ->badge() // স্ট্যাটাসকে সুন্দর ব্যাজ হিসেবে দেখাবে
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'active' => 'success',
                        'rented' => 'danger',
                        'inactive' => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('তৈরির তারিখ')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // ডিফল্টভাবে এই কলামটি হাইড থাকবে
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
