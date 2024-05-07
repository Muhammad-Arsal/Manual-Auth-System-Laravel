<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    protected $table = "admin";

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    use HasFactory;
}
