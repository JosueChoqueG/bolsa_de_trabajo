<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    protected $table = 'geolocation';
    //protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = [
        'departament_code', 
        'province_code',
        'district_code',
        'name'
    ];

    protected $casts = [
        'id'               => 'string',
        'departament_code'  => 'string', 
        'province_code'     => 'string',
        'district_code'     => 'string',
        'name'              => 'string'
    ];

    //relaciones
    
    public function employers()
    {
        return $this->hasMany('App\Model\Employer','geolocation_id', 'id');
    }

    public function job_offers()
    {
        return $this->hasMany('App\Model\JobOffer','geolocation_id', 'id');
    }
}
