<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyTax extends Model
{   

    use HasFactory;
    protected $table = "property_taxes";
    protected $primaryKey = "property_tax_id";
    public $timestamps = false;
    protected $fillable = ["tax_id", "property_id"];
    
    public function property(): BelongsTo{
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function tax(): BelongsTo{
        return $this->belongsTo(Tax::class, 'tax_id', 'tax_id');
    }
}
