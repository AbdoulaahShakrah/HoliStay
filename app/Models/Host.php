<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Host extends Model
{
    use HasFactory;

    protected $table = "hosts";
    protected $primaryKey = "host_id";

    protected $fillable = ["user_id", "host_description", "job", "iban", "nif"];

    public function client(): BelongsTo{
        return $this->belongsTo(Client::class, 'user_id', 'client_id');
    }

    public function properties(): HasMany{
        return $this->hasMany(Property::class, 'host_id', 'host_id');
    }
}
