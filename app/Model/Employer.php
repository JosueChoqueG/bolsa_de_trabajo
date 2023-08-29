<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employer extends Model
{
    use SoftDeletes;
    
    protected $table        = 'employer';
	protected $primaryKey   = 'id';
    public $timestamps      = true;

   protected $fillable=[
        'id',
        'ruc',                   
        'name',                  
        'tradename',             
        'geolocation_id',
        'address',
        'economic_activity',
        'email',
        'password',
        'sector_id',
        'description',
        'web_page',
        'path_logo',
        'contact_name',
        'contact_lastname',
        'contact_role',
        'contact_first_phone',
        'contact_second_phone',
        'status'
    ];
    protected $casts        = [
        'id'                    =>'integer',
        'ruc'                   =>'string',
        'name'                  =>'string',
        'tradename'             =>'string',
        'geolocation_id'        =>'integer',
        'address'               =>'string',
        'economic_activity'     =>'string',
        'email'                 =>'string',
        'password'              =>'string',
        'sector_id'             =>'integer',
        'description'           =>'string',
        'web_page'              =>'string',
        'path_logo'             =>'string',
        'contact_name'          =>'string',
        'contact_lastname'      =>'string',
        'contact_role'          =>'string',
        'contact_first_phone'   =>'string',
        'contact_second_phone'  =>'string',
        'status'                =>'string'
    ];
    //accesors
    // public function getPathLogoAttribute($value)
    // {
    //     if(is_null($value) && empty($value)){
    //         $value='default.JPG';
    //     }
    //     return $value;
    // }
    //mutators
    public function setPasswordAttribute($value)
    {
        if(! is_null($value))
            $this->attributes['password'] = \Hash::make($value);
    }

    public function sector()
    {
        return $this->belongsTo('App\Model\Sector');
    }

    //scopes
    public function scopeRuc($query, $parametro)
    {
        if ($parametro) 
			return $query->where('ruc', 'LIKE', "%".$parametro."%");   
	}

	public function scopeName($query, $parametro)
    {
        if ($parametro) 
			return $query->where('name', 'LIKE', "%".$parametro."%")->orWhere('tradename', 'LIKE', "%".$parametro."%");   
    }
    
    public function scopeStatus($query, $parametro)
    {
        if ($parametro) 
			return $query->where('status', 'LIKE', "%".$parametro."%");   
    }
    
    public function scopeSector($query, $parametro)
    {
        if ($parametro) 
			return $query->where('sector_id', $parametro);   
	}
}
