<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
    use HasFactory, InteractsWithMedia, SoftDeletes, HasCustomSlug;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'property_code',
        'purpose',
        'property_type',
        'rent_price',
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
        'address_street',
        'address_city',
        'address_area',
        'address_zipcode',
        'google_maps_location_link',
        'latitude',
        'longitude',
        'additional_features',
        'house_rules',
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
    ];

    protected $casts = [
        'user_id' => 'integer',
        'rent_price' => 'integer',
        'service_charge' => 'integer',
        'security_deposit' => 'integer',
        'is_negotiable' => 'boolean',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'balconies' => 'integer',
        'size_sqft' => 'integer',
        'total_floors' => 'integer',
        'year_built' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'additional_features' => 'array',
        'is_available' => 'boolean',
        'available_from' => 'date',
        'is_featured' => 'boolean',
        'is_trending' => 'boolean',
        'is_verified' => 'boolean',
        'views_count' => 'integer',
        'reviews_count' => 'integer',
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
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 832, 472) // <-- আমাদের মূল কাজটি এখানে হচ্ছে
            ->nonQueued() // থাম্বনেইলটি আপলোডের সাথে সাথেই তৈরি হবে
            ->performOnCollections('properties'); // শুধু 'properties' কালেকশনের ছবির জন্য এটি প্রযোজ্য
    }

    // Belongs To User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
        return $this->hasMany(Review::class);
    }

    /**
     * Get all of the messages for the Property.
     * একটি প্রপার্টির জন্য অনেকগুলো মেসেজ থাকতে পারে।
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
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
