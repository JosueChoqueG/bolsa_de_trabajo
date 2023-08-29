<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table      = 'role';
    protected $dates      = ['deleted_at'];
    public $timestamps    = false;
    
    protected $fillable = [
        'name', 
        'description', 
    ];

    protected $casts = [
        'name'        =>'string', 
        'description' => 'string', 
    ];
    //relations
    public function routes(){
		return $this->belongsToMany('App\Model\Route','route_role','role_id','route_id');
	}
}
