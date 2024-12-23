<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "user_roles";
    protected $primaryKey = "client_id";
    protected $connection = 'mysql_users';
    use HasFactory;


    public function roles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }
}
