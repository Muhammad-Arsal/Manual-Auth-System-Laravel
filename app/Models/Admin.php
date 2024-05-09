<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasFactory;

    protected $table = "admin";

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function sendPasswordResetNotification($token)
    {
        $url =  $token;

        $this->notify(new ResetPasswordNotification($url));
    }
}
