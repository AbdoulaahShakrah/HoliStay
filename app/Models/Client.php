<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Client extends Model
{
    use HasFactory;

    protected $table = "clients";
    protected $primaryKey = "client_id";
    public $timestamps = false;

    
    public function reservations(): HasMany {
        return $this->hasMany(Reservation::class, 'client_id', 'client_id');
    }

    public function host(): HasOne{
        return $this->hasOne(Host::class, 'host_id', 'host_id');
    }
}
