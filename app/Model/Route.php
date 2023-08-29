<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table      = 'route';
    public $timestamps    = false;
    
    protected $fillable = [
        'name',
        'value', 
        'description', 
    ];

    protected $casts = [
        'name'        =>'string',
        'value'       => 'string',
        'description' => 'string', 
    ];
    //relations

    public function roles(){
		return $this->belongsToMany('App\Model\Role','route_role','role_id','route_id');
	}
}
