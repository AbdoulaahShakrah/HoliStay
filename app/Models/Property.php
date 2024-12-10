<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $table = "properties";
    protected $primaryKey = "property_id";

    public function host(): BelongsTo{
        return $this->belongsTo(Host::class, 'host_id', 'host_id');
    }

    public function reservations(): HasMany{
        return $this->hasMany(Reservation::class, 'property_id', 'property_id');
    }

    public function photos(): HasMany{
        return $this->hasMany(Photo::class, 'property_id', 'property_id');
    }

    public function property_taxes(): HasMany{
        return $this->hasMany(PropertyTax::class, 'property_id', 'property_id');
    }

    public function property_amenities(): HasMany{
        return $this->hasMany(PropertyAmenity::class, 'property_id', 'property_id');
    }

}
