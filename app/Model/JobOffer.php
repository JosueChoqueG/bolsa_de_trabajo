<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOffer extends Model
{
    use SoftDeletes;
    
    protected $table        = 'job_offer';
    protected $dates        = ['deleted_at'];
	protected $primaryKey   = 'id';
    public $timestamps      = true;
    protected $casts        = [
        'id'                            =>'integer',
        'user_id'                       =>'integer',
        'type'                          =>'string',
        'category'                      =>'string',
        'title'                         =>'string',
        'title_complement'              =>'string',
        'description'                   =>'string',
        'countrie_id'                   =>'string',
        'geolocation_id'                =>'string',
        'workday'                       =>'string',
        'area_id'                       =>'integer',
        'type_salary'                   =>'string',
        'type_validity'                 =>'string',
        'academic_level'                =>'string',
        'validity_time'                 =>'string',
        'vacancies'                     =>'integer',
        'publication_date'              =>'string',
        'finish_date'                   =>'string',
        'salary_min'                    =>'float',
        'salary_max'                    =>'float',
        'collage_id'                    =>'integer',
        'view_counter'                  =>'integer',
        'employer_id'                   =>'integer',
        'status'                        =>'integer',
        'additional_information'        =>'string',
        'path_logo'                     =>'string',
        'introduction'                  =>'string',
        'slug'                          =>'string',
        'is_postulation'                =>'integer'  
        
    ];

    protected $fillable =[
        'id',  
        'user_id',                          
        'type',                          
        'category',                      
        'title'    ,                     
        'title_complement',           
        'description'      ,             
        'countrie_id' ,
        'geolocation_id',
        'workday' ,
        'area_id' ,
        'type_salary',
        'type_validity',
        'academic_level' ,
        'validity_time' ,         
        'vacancies',         
        'publication_date',          
        'finish_date',          
        'salary_min',
        'view_counter',          
        'salary_max',          
        'collage_id',          
        'employer_id',          
        'status',          
        'additional_information',        
        'path_logo',    
        'introduction',    
        'slug',
        'is_postulable'
    ];
    // public function getPathLogoAttribute($value)
    // {
    //     if(is_null($value) && empty($value)){
    //         $value='default.JPG';
    //     }
    //     return $value;
    // }

    public function geolocation()
    {
        return $this->belongsTo('App\Model\Geolocation');
    }

    public function employer()
    {
        return $this->belongsTo('App\Model\Employer');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
    public function area()
    {
        return $this->belongsTo('App\Model\Area');
    }
    public function countrie()
    {
        return $this->belongsTo('App\Model\Countrie');
    }

    public function postulations()
    {
        return $this->hasMany('App\Model\Postulation', 'job_offer_id', 'id');
        
    }

    public function emails()
    {
        return $this->hasMany('App\Model\EmailJobOffer', 'job_offer_id', 'id')->orderBy('created_at','DESC');
        
    }
    public function college_careers()
    {
        return $this->belongsToMany('App\Model\CollegeCareer','offer_college','job_offer_id','college_id');
    }
    //scopes

    public function scopeOrder($query, $value)
    {
        if ($value == 'salary_min' || $value == 'publication_date')  
            return $query->orderBy($value,'DESC'); 
        if(is_null($value))    
            return $query->orderBy('publication_date','DESC');   
    }
    public function scopeCountries($query, $array)
    {
        if ($array && is_array($array))  
			return $query->whereIn('countrie_id',$array);   
    }
    public function scopeGeolocations($query, $array)
    {
        if ($array && is_array($array))  
			return $query->whereIn('geolocation_id',$array);   
    }
    public function scopeAreas($query, $array)
    {
        if ($array && is_array($array))  
			return $query->whereIn('area_id',$array);   
    }
    public function scopeTitle($query, $parametro)
    {
        if ($parametro) 
			return $query->where('title', 'LIKE', "%".$parametro."%")->orWhere('title_complement', 'LIKE', "%".$parametro."%");   
    }
    public function scopeWorkday($query, $parametro)
    {
        if ($parametro) 
			return $query->where('workday', 'LIKE', "%".$parametro."%");   
    }
    public function scopeCategory($query, $parametro)
    {
        if ($parametro) 
			return $query->where('category', 'LIKE', "%".$parametro."%");   
    }

    public function scopeEmployer($query, $parametro)
    {
        if ($parametro && $parametro != 0) 
			return $query->where('employer_id', '=',$parametro);   
    }
    
    public function scopeType($query, $parametro)
    {
        if ($parametro) 
			return $query->where('type', 'LIKE', "%".$parametro."%");   
    }

    public function scopeStatus($query, $parametro)
    {
        if ($parametro) 
			return $query->where('status', 'LIKE', "%".$parametro."%");   
    }
}

