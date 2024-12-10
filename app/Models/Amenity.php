<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
    use HasFactory;

    protected $table = "amenities";
    protected $primaryKey = "amenities_id";
    public $timestamps = false;

    
    public function property_amenities(): HasMany{
        return $this->hasMany(PropertyAmenity::class, 'amenity_id', 'amenity_id');
        
    }
}