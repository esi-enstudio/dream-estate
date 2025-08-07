<?php

namespace App\Models;

use App\Traits\HasCustomSlug;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasCustomSlug;

    protected $fillable = ['name','slug','icon_class','type','is_key_feature'];

    public function getSluggableField(): string
    {
        return 'name';
    }

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }
}
