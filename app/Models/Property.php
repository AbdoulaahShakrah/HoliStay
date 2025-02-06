<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "properties";
    protected $primaryKey = "property_id";
    protected $fillable = [ "host_id",
                            "property_name", 
                            "property_country",
                            "property_city",
                            "property_address",
                            "property_type",
                            "property_bedrooms", 
                            "property_bathrooms",
                            "property_beds",
                            "cancellation_policy",
                            "property_price",
                            "property_status", 
                            "property_capacity", 
                            "property_description",
                            'page_visits'
                        ];
    public function host(): BelongsTo
    {
        return $this->belongsTo(Host::class, 'host_id', 'host_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'property_id', 'property_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'property_id', 'property_id');
    }

    public function property_taxes(): HasMany
    {
        return $this->hasMany(PropertyTax::class, 'property_id', 'property_id');
    }

    public function property_amenities(): HasMany
    {
        return $this->hasMany(PropertyAmenity::class, 'property_id', 'property_id');
    }
}
