<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class EmailVerification extends Model
{
    protected $table = "user_email_verification";

    protected $fillable = [
        'admin_id','token'
    ];

    public $timestamps = false;

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    use HasFactory;
}
