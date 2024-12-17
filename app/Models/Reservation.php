<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $table = "reservations";
    protected $primaryKey = "reservation_id";
    protected $fillable = ["property_id", "client_id", "check_in_date", "check_out_date", "reservation_status", "reservation_amount"];

    public function client(): BelongsTo{
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function payment(): HasOne{
        return $this->hasOne(Payment::class, 'reservation_id', 'reservation_id');
    }
}
