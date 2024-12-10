<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;
    protected $table = "taxes";
    protected $primaryKey = "tax_id";
    public $timestamps = false;


    public function property_tax(): HasMany{
        return $this->hasMany(PropertyTax::class, 'tax_id', 'tax_id');
    }
}
