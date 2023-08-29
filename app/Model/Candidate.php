<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;
    protected $table        = 'candidate';
    protected $dates        = ['deleted_at'];
    protected $primaryKey   ='id';
    public $timestamps      = true;
    protected $casts        =[
        'id'              =>'integer',
        'document'        =>'string',
        'name'            =>'string',
        'first_lastname'  =>'string',
        'second_lastname' =>'string',
        'gender'          =>'string',
        'birthdate'       =>'string',
        'civil_status'    =>'string',
        'first_phone'     =>'string',
        'second_phone'    =>'string',
        'email'           =>'string',
        'path_photo'      =>'string',
        'disability'      =>'string',
        'status'          =>'integer',
        'password'        =>'string'
    ];

    protected $fillable=[
        'id',
        'document',
        'name',
        'first_lastname',
        'second_lastname',
        'gender',
        'birthdate',
        'first_phone',
        'second_phone',
        'email',
        'path_photo',
        'disability',
        'status',
        'password',
        'activity_date'                    
    ];

    public function college_careers()
    {
        return $this->belongsToMany('App\Model\CollegeCareer','candidate_college','candidate_id','college_id')->withPivot('code','candidate_id','college_id');
    }

    public function curriculum_vitaes()
    {
        return $this->hasMany('App\Model\CurriculumVitae','candidate_id','id');
    }
    
    public function sessions()
    {
        return $this->hasMany('App\Model\Sessions','user_id','id');
    }
    
    //mutators
    public function setPasswordAttribute($value)
    {
        if(! is_null($value))
            $this->attributes['password'] = \Hash::make($value);
    }
    //accesors
    public function getPathPhotoAttribute($value)
    {
        if(is_null($value) && empty($value)){
            $value='default.JPG';
        }
        return $value;
    }
    //scopes
    public function scopeDocument($query, $parametro)
    {
        if ($parametro) 
			return $query->where('document', 'LIKE', "%".$parametro."%");   
	}

	public function scopeName($query, $parametro)
    {
        if ($parametro) 
			return $query->where('name', 'LIKE', "%".$parametro."%");   
    }
    public function scopeLastname($query, $parametro)
    {
        if ($parametro) 
			return $query->where('first_lastname', 'LIKE', "%".$parametro."%")->orWhere('second_lastname', 'LIKE', "%".$parametro."%");   
    }
    
    public function scopeSex($query, $parametro)
    {
        if ($parametro) 
			return $query->where('gender', 'LIKE', "%".$parametro."%");   
    }
    
}
