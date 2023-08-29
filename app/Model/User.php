<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model
{
    use SoftDeletes;
    protected $table      = 'user';
    protected $dates        = ['deleted_at'];
    public $timestamps    = true;
    
    protected $fillable = [
        'name', 
        'last_name', 
        'email', 
        'password',
        'status',
        'role_id'
    ];

    protected $casts = [
        'name' => 'string', 
        'last_name' => 'string', 
        'email' => 'string', 
        'password' => 'string',
        'status' =>   'integer',
        'role_id' =>'integer'
    ];
    public function role()
    {
        return $this->belongsTo('App\Model\Role');
    }
    public function setPasswordAttribute($value)
    {
        if(! empty($value)){
            $this->attributes['password']=\Hash::make($value);
        }
    }
    
}
