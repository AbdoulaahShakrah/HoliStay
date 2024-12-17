<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $table = "photos";
    protected $primaryKey = "photo_id";
    public $timestamps = false;
    protected $fillable = ["property_id", "photo_url"];

    public function property(): BelongsTo{
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}
