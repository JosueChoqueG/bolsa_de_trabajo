<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table      = 'password_reset';
    public $timestamps    = true;
    
    protected $fillable = [
        'email', 
        'user_type',
        'token', 
        'created_at'
    ];

    protected $casts = [
        'email'      => 'string',  
        'user_type'  => 'string',
        'token'      => 'string', 
        'created_at' => 'string'
    ];
}
