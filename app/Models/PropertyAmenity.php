<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PropertyAmenity extends Model
{
    use HasFactory;
    protected $table = "property_amenities";
    protected $primaryKey = "property_amenity_id";
    public $timestamps = false;

    public function property(): BelongsTo{
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function amenity(): BelongsTo{
        return $this->belongsTo(Amenity::class, 'amenity_id', 'amenity_id');
    }
}
