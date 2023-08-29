<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RouteRole extends Model
{
    protected $table      = 'route_role';
    public $timestamps    = false;
    
    protected $fillable = [
        'route_id', 
        'role_id', 
    ];

    protected $casts = [
        'route_id' =>'integer', 
        'role_id'   =>'integer', 
    ];
}
