<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\RelationManagers\AmenitiesRelationManager;
use App\Filament\Resources\PropertyResource\RelationManagers\EnquiriesRelationManager;
use App\Filament\Resources\PropertyResource\RelationManagers\ReviewsRelationManager;
use App\Filament\Resources\PropertyResource\RelationManagers\WishlistedByRelationManager;
use App\Models\District;
use App\Models\PropertyType;
use App\Models\Union;
use App\Models\Upazila;
use Exception;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use App\Models\Property;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
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
                        Grid::make()
                        ->columnSpan(2)
                        ->columns(3)
                        ->schema([
                            // Edit Form Fields
                            TextInput::make('views_count')
                                ->label('ভিউ সংখ্যা')
                                ->disabled()
                                ->dehydrated(false)
                                ->visibleOn(['edit','view']),

                            TextInput::make('reviews_count')
                                ->label('রিভিউ সংখ্যা')
                                ->disabled()
                                ->dehydrated(false)
                                ->visibleOn(['edit','view']),

                            TextInput::make('average_rating')
                                ->label('গড় রেটিং')
                                ->disabled()
                                ->dehydrated(false)
                                ->visibleOn(['edit','view']),
                        ]),

                        // --- Main Column ---
                        Grid::make()
                            ->columnSpan(2)
                            ->schema([
                                Section::make('মূল তথ্য (Core Information)')
                                    ->collapsible()
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
                                    ->collapsible()
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
                                    ->collapsible()
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                // Property Type
                                                Select::make('property_type_id')
                                                    ->relationship(
                                                        'propertyType', // relationship name
                                                        'name_en' // default title column (will be overridden by getOptionLabelFromRecordUsing)
                                                    )
                                                    ->getOptionLabelFromRecordUsing(function (PropertyType $record) {
                                                        return "{$record->name_en} ({$record->name_bn})";
                                                    })
                                                    ->searchable(['name_en', 'name_bn'])
                                                    ->helperText('এটি কি ফ্ল্যাট, ডুপ্লেক্স নাকি অন্য কোনো ধরনের প্রপার্টি? তা নির্বাচন করুন।')
                                                    ->label('Property Type')
                                                    ->live()
                                                    ->preload()
                                                    ->required(),

                                                // Bedrooms - শুধু আবাসিক প্রপার্টির জন্য
                                                Select::make('bedrooms')
                                                    ->label('বেডরুম')
                                                    ->options(array_combine(range(0, 10), range(0, 10)))
                                                    ->required()
                                                    ->visible(function ($get) {
                                                        $propertyType = PropertyType::find($get('property_type_id'));
                                                        return in_array($propertyType?->slug, ['apartment', 'duplex', 'tin-shed', 'semi-ripe', 'room', 'house', 'villa', 'penthouse']);
                                                    }),

                                                // Bathrooms - শুধু আবাসিক প্রপার্টির জন্য
                                                Select::make('bathrooms')
                                                    ->label('বাথরুম')
                                                    ->options(array_combine(range(0, 10), range(0, 10)))
                                                    ->required()
                                                    ->visible(function ($get) {
                                                        $propertyType = PropertyType::find($get('property_type_id'));
                                                        return in_array($propertyType?->slug, ['apartment', 'duplex', 'tin-shed', 'semi-ripe', 'room', 'house', 'villa', 'penthouse']);
                                                    }),

                                                // Balconies - শুধু এপার্টমেন্ট/ডুপ্লেক্স/পেন্টহাউস এর জন্য
                                                Select::make('balconies')
                                                    ->label('বারান্দা')
                                                    ->options(array_combine(range(0, 10), range(0, 10)))
                                                    ->visible(function ($get) {
                                                        $propertyType = PropertyType::find($get('property_type_id'));
                                                        return in_array($propertyType?->slug, ['apartment', 'duplex', 'penthouse']);
                                                    }),

                                                // Size - সব প্রপার্টির জন্য
                                                TextInput::make('size_sqft')
                                                    ->label('আকার (স্কয়ার ফিট)')
                                                    ->required()
                                                    ->numeric(),

                                                // Floor level - এপার্টমেন্ট, ডুপ্লেক্স, কমার্শিয়াল স্পেস, অফিসের জন্য
                                                TextInput::make('floor_level')
                                                    ->label('ফ্লোর লেভেল')
                                                    ->numeric()
                                                    ->maxLength(255)
                                                    ->visible(function ($get) {
                                                        $propertyType = PropertyType::find($get('property_type_id'));
                                                        return in_array($propertyType?->slug, ['apartment', 'duplex', 'commercial-space', 'office', 'penthouse', 'shopping-mall']);
                                                    }),

                                                // Total floors - মাল্টি-স্টোরি বিল্ডিং এর জন্য
                                                TextInput::make('total_floors')
                                                    ->label('মোট তলা')
                                                    ->numeric()
                                                    ->minValue(1)
                                                    ->maxValue(100)
                                                    ->nullable()
                                                    ->visible(function ($get) {
                                                        $propertyType = PropertyType::find($get('property_type_id'));
                                                        return in_array($propertyType?->slug, ['apartment', 'duplex', 'commercial-space', 'office', 'shopping-mall', 'hospital', 'hotel']);
                                                    }),

                                                // Facing direction - আবাসিক প্রপার্টির জন্য
                                                Select::make('facing_direction')
                                                    ->label('কোনমুখী ফ্ল্যাট')
                                                    ->options([
                                                        'south' => 'দক্ষিণ',
                                                        'north' => 'উত্তর',
                                                        'east' => 'পূর্ব',
                                                        'west' => 'পশ্চিম',
                                                        'south-east' => 'দক্ষিণ-পূর্ব',
                                                        'north-east' => 'উত্তর-পূর্ব',
                                                    ])
                                                    ->visible(function ($get) {
                                                        $propertyType = PropertyType::find($get('property_type_id'));
                                                        return in_array($propertyType?->slug, ['apartment', 'duplex', 'room', 'house', 'villa', 'penthouse']);
                                                    }),

                                                // Year built - সব প্রপার্টির জন্য
                                                TextInput::make('year_built')
                                                    ->label('নির্মাণ সাল')
                                                    ->numeric()
                                                    ->maxValue(date('Y')),
                                            ])
                                    ]),

                                Section::make('অতিরিক্ত সুবিধা ও নিয়মাবলী (Additional Features & Rules)')
                                    ->schema([
                                        KeyValue::make('additional_features')
                                            ->label('অন্যান্য সুবিধা')
                                            ->keyLabel('ফিচারের নাম') // "Key" ইনপুট ফিল্ডের লেবেল
                                            ->valueLabel('সংখ্যা বা বিবরণ') // "Value" ইনপুট ফিল্ডের লেবেল
                                            ->addActionLabel('নতুন সুবিধা যোগ করুন') // নতুন আইটেম যোগ করার বাটনের লেখা
                                            ->helperText('এখানে ফ্ল্যাটের ভেতরের অতিরিক্ত সুবিধাগুলো যোগ করুন, যেমন - AC, Fridge, Geyser ইত্যাদি।')
                                            ->columnSpanFull(),

                                        Textarea::make('house_rules')
                                            ->label('বাসার নিয়মাবলী')
                                            ->rows(5)
                                            ->helperText('প্রতিটি নিয়ম একটি নতুন লাইনে লিখুন।'),
                                    ])
                                    ->collapsible(), // এই সেকশনটি খোলা বা বন্ধ করা যাবে

                                Section::make('অবস্থান (Location)')
                                    ->collapsible()
                                    ->schema([
                                        Grid::make(2)->schema([
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
                                            TextInput::make('address_zipcode')->label('জিপ কোড')->numeric()->nullable(),
                                            TextInput::make('google_maps_location_link')->label('গুগল ম্যাপস লিংক')->url(),

                                            TextInput::make('latitude')
                                                ->label('Latitude (অক্ষাংশ)')
                                                ->helperText('যেমন: 23.77701234')
                                                ->nullable()
                                                // ডেটাবেসে পাঠানোর আগে ফরম্যাট করা
                                                ->dehydrateStateUsing(fn (?string $state): ?string => $state ? rtrim(rtrim($state, '0'), '.') : null)
                                                ->rule('regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'), // অক্ষাংশের জন্য ভ্যালিডেশন

                                            TextInput::make('longitude')
                                                ->label('Longitude (দ্রাঘিমাংশ)')
                                                ->helperText('যেমন: 90.39945100')
                                                ->nullable()
                                                // ডেটাবেসে পাঠানোর আগে ফরম্যাট করা
                                                ->dehydrateStateUsing(fn (?string $state): ?string => $state ? rtrim(rtrim($state, '0'), '.') : null)
                                                ->rule('regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'), // দ্রাঘিমাংশের জন্য ভ্যালিডাউনলোড
                                        ]),
                                    ]),

                                Section::make('সাধারণ জিজ্ঞাসা (FAQ)')
                                    ->schema([
                                        Repeater::make('faqs')
                                            ->label('') // সেকশনের টাইটেলই যথেষ্ট, তাই লেবেল খালি রাখা হলো
                                            ->schema([
                                                TextInput::make('question')
                                                    ->label('প্রশ্ন')
                                                    ->required(),

                                                RichEditor::make('answer')
                                                    ->label('উত্তর')
                                                    ->required()
                                                    ->columnSpanFull(),
                                            ])
                                            ->columns(1)
                                            ->addActionLabel('নতুন প্রশ্ন যোগ করুন')
                                            ->collapsible() // প্রতিটি আইটেম খোলা/বন্ধ করা যাবে
                                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null), // আইটেমের লেবেল হিসেবে প্রশ্নটি দেখাবে
                                    ])
                                    ->collapsible(),
                            ]),

                        // --- Sidebar Column ---
                        Grid::make()
                            ->columnSpan(1)
                            ->schema([
                                Section::make('স্ট্যাটাস ও ভিজিবিলিটি')
                                    ->collapsible()
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

                                        Select::make('purpose')
                                            ->label('উদ্দেশ্য')
                                            ->options([
                                                'rent' => 'ভাড়া (Rent)',
                                                'sell' => 'বিক্রয় (Sell)',
                                            ])
                                            ->default('rent')
                                            ->required(),

                                        Select::make('rent_type')
                                            ->label('ভাড়ার ধরন')
                                            ->native(false) // <-- এই লাইনটি যোগ করুন
                                            ->options([
                                                'day'   => 'প্রতিদিন (Per Day)',
                                                'week'  => 'প্রতি সপ্তাহ (Per Week)',
                                                'month' => 'প্রতি মাস (Per Month)',
                                                'year'  => 'প্রতি বছর (Per Year)',
                                            ])
                                            ->default('month')
                                            ->required(),

                                        Select::make('is_negotiable')
                                            ->label('মূল্য আলোচনা সাপেক্ষ')
                                            ->options([
                                                'negotiable' => 'আলোচনা সাপেক্ষে (Negotiable)',
                                                'fixed' => 'অপরিবর্তনীয় (Fixed)',
                                            ])
                                            ->default('fixed')
                                            ->required(),

                                        Toggle::make('is_available')
                                            ->label('উপলব্ধ কি না')
                                            ->default(true),

                                        Toggle::make('is_trending')
                                            ->label('ট্রেন্ডিং কি না')
                                            ->default(false)
                                            ->helperText('ট্রেন্ডিং ব্যাজ দেখানোর জন্য'),

                                        Toggle::make('is_featured')
                                            ->label('ফিচার্ড হিসেবে দেখান')
                                            ->helperText('ফিচার্ড বাসাগুলো হোমপেজে প্রাধান্য পাবে।'),

                                        Toggle::make('is_verified')
                                            ->label('ভেরিফাইড')
                                            ->helperText('এই বাসাটি প্ল্যাটফর্ম দ্বারা যাচাইকৃত।'),
                                    ]),

                                Section::make('ছবি ও ভিডিও (Media)')
                                    ->collapsible()
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

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->query(
                fn() => static::getModel()::query()->with(['user'])
            )
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

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('ফিচার্ড'),

                Tables\Columns\ToggleColumn::make('is_verified')
                    ->label('ভেরিফাইড'),

                TextColumn::make('status')
                    ->badge() // স্ট্যাটাসকে সুন্দর ব্যাজ হিসেবে দেখাবে
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'active' => 'success',
                        'rented' => 'danger',
                        'inactive' => 'gray',
                        'sold_out' => 'danger',
                    }),

                TextColumn::make('created_at')
                    ->label('তৈরির তারিখ')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // ডিফল্টভাবে এই কলামটি হাইড থাকবে
            ])
            ->defaultPaginationPageOption(5)
            ->deferLoading()
            ->filters([
                Tables\Filters\SelectFilter::make('district')
                    ->relationship('district', 'bn_name'),
                Tables\Filters\TernaryFilter::make('is_available')->label('Available'),
                Tables\Filters\TernaryFilter::make('rent_type')->label('Rent Type'),
                Tables\Filters\TernaryFilter::make('purpose')->label('Rent/Sell'),
                Tables\Filters\TernaryFilter::make('status')->label('Status'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Action::make('create')
                    ->label('Add New')
                    ->url(route('filament.superadmin.resources.properties.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Grid::make(3)->schema([
                    \Filament\Infolists\Components\Grid::make()->columnSpan(2)->schema([
                        \Filament\Infolists\Components\Section::make('Property Information')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('title'),
                                TextEntry::make('property_code'),
                                TextEntry::make('propertyType.name')->label('Type'),
                                TextEntry::make('purpose')->badge(),
                                TextEntry::make('description')
                                    ->columnSpanFull()
                                    ->html(),
                            ]),
                        \Filament\Infolists\Components\Section::make('Specifications')
                            ->columns(3)
                            ->schema([
                                TextEntry::make('bedrooms')->icon('heroicon-o-building-office'),
                                TextEntry::make('bathrooms')->icon('heroicon-o-building-office-2'),
                                TextEntry::make('size_sqft')->label('Size (sqft)'),
                                TextEntry::make('floor_level'),
                                TextEntry::make('facing_direction'),
                                TextEntry::make('year_built'),
                            ]),
                        \Filament\Infolists\Components\Section::make('Media')
                            ->schema([
                                SpatieMediaLibraryImageEntry::make('featured_image')
                                    ->collection('featured_image')
                                    ->label('Featured Image'),
                                SpatieMediaLibraryImageEntry::make('gallery_images')
                                    ->collection('gallery')
                                    ->label('Gallery'),
                            ]),
                    ]),

                    \Filament\Infolists\Components\Grid::make()->columnSpan(1)->schema([
                        \Filament\Infolists\Components\Section::make('Status & Pricing')
                            ->schema([
                                TextEntry::make('status')->badge(),
                                TextEntry::make('rent_price')->money('BDT'),
                                IconEntry::make('is_negotiable')->boolean(),
                                IconEntry::make('is_featured')->boolean(),
                                IconEntry::make('is_verified')->boolean(),
                            ]),
                        \Filament\Infolists\Components\Section::make('Location')
                            ->schema([
                                TextEntry::make('address_street'),
                                TextEntry::make('address_area'),
                                TextEntry::make('address_city'),
                            ]),
                    ]),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AmenitiesRelationManager::class,
            EnquiriesRelationManager::class,
            ReviewsRelationManager::class,
            WishlistedByRelationManager::class,
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
