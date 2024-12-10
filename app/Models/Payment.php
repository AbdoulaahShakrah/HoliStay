<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";
    protected $primaryKey = "payment_id";

    public function reservation(): BelongsTo{
        return $this->belongsTo(Reservation::class, 'reservation_id', 'reservation_id');
    }
}
