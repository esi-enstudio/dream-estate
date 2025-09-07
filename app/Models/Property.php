<?php

namespace App\Models;

use App\Traits\TracksViews;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Traits\HasCustomSlug;
use Spatie\MediaLibrary\HasMedia;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model implements HasMedia
{
    /** @use HasFactory<PropertyFactory> */
    use HasFactory, InteractsWithMedia, SoftDeletes, HasCustomSlug, TracksViews;

    protected $fillable = [
        'user_id',
        'property_type_id',
        'tenant_id',
        'title',
        'slug',
        'description',
        'property_code',
        'purpose',
        'rent_price',
        'rent_type',
        'service_charge',
        'security_deposit',
        'is_negotiable',
        'bedrooms',
        'bathrooms',
        'balconies',
        'size_sqft',
        'floor_level',
        'total_floors',
        'facing_direction',
        'year_built',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'address_street',
        'address_area',
        'address_zipcode',
        'google_maps_location_link',
        'latitude',
        'longitude',
        'house_rules',
        'faqs',
        'additional_features',
        'video_url',
        'status',
        'is_available',
        'available_from',
        'is_featured',
        'is_trending',
        'is_verified',
        'views_count',
        'reviews_count',
        'average_rating',
        'score',
    ];

    protected $casts = [
        // --- অপরিহার্য কাস্টগুলো ---

        // ডেটাবেসের boolean (TINYINT(1)) কলামগুলোকে PHP-র true/false এ রূপান্তরের জন্য।
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'is_trending' => 'boolean',
        'is_verified' => 'boolean',

        // ডেটাবেসের date/datetime স্ট্রিংকে শক্তিশালী Carbon অবজেক্টে রূপান্তরের জন্য।
        'available_from' => 'date',

        // ডেটাবেসের JSON স্ট্রিংকে PHP অ্যারেতে রূপান্তরের জন্য।
        'additional_features' => 'array',
        'faqs' => 'array',

        // ডেটাবেসের decimal স্ট্রিংকে PHP ফ্লোটিং-পয়েন্ট নম্বরে রূপান্তরের জন্য (গণনার জন্য জরুরি)।
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'average_rating' => 'decimal:1',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function ($property) {
            $prefix = 'PROP-'; // আপনার পছন্দের প্রিফিক্স

            do {
                // ৮ অক্ষরের একটি র‍্যান্ডম, বড় হাতের অক্ষর ও সংখ্যার স্ট্রিং তৈরি করুন
                $randomPart = strtoupper(Str::random(10));
                $code = $prefix . $randomPart;
            } while (self::where('property_code', $code)->exists());

            $property->property_code = $code;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }

    public function getSluggableField(): string
    {
        return 'title'; // Use slug instead of id in routes
    }

    /**
     * Define the media conversions for the model.
     *
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // ফিচার্ড ছবির জন্য থাম্বনেইল কনভার্সন
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 832, 472)
            ->nonQueued()
            ->performOnCollections('featured_image'); // <-- শুধুমাত্র 'featured_image' কালেকশনের জন্য

        // (ঐচ্ছিক) গ্যালারির ছবির জন্য ছোট প্রিভিউ
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Crop, 856, 500)
            ->nonQueued()
            ->performOnCollections('gallery');
    }

    protected function rentType(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Str::title($value)
        );
    }

    protected function addressStreet(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Str::limit($value, 30)
        );
    }

    // Belongs To User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }

    // Belongs To Location Hierarchy
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union(): BelongsTo
    {
        return $this->belongsTo(Union::class);
    }

    /**
     * Get the property type that owns the Property.
     */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'property_tenant');
    }

    /**
     * The amenities that belong to the property.
     */
    public function amenities(): BelongsToMany
    {
        // একটি প্রপার্টির অনেকগুলো সুবিধা থাকতে পারে
        return $this->belongsToMany(Amenity::class)
            ->withPivot('details','is_key_feature') // <-- পিভট টেবিলের 'details' কলামটি অ্যাক্সেস করার জন্য
            ->withTimestamps();
    }

    /**
     * একটি বাসার সকল রিভিউ।
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->whereNull('parent_id'); // Only top-level reviews
    }

    public function approvedReviews() {
        return $this->reviews()->where('status', 'approved');
    }

    public function wishlistedByUsers(): BelongsToMany
    {
        // একটি প্রপার্টি অনেক ইউজার দ্বারা wishlisted হতে পারে
        return $this->belongsToMany(User::class, 'wishlists')
            ->withTimestamps();
    }

    /**
     * গড় রেটিং ক্যালকুলেট করার জন্য একটি Helper মেথড
     */
    public function averageRating(): float
    {
        // reviews_avg_rating নামে একটি অ্যাট্রিবিউট থাকলে সেটি ব্যবহার করবে,
        // নাহলে সরাসরি ডাটাবেস থেকে অ্যাভারেজ ক্যালকুলেট করবে।
        return $this->reviews()->avg('rating') ?? 0;
    }


}
