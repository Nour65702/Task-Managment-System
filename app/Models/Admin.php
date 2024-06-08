<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    protected $guard = 'admin';
    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $casts = [
        'password'=> 'hashed',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
}
