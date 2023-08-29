<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CollegeCareer extends Model
{
    protected $table        = 'college_career';
	protected $primaryKey   = 'id';
    public $timestamps      = true;
    protected $casts        = [
        'name'                          =>'string',
        'short_name'                    =>'string',
        'visibility'                    => 'integer'
    ];
    protected $fillable     = [                   
        'name',                       
        'short_name',    
        'visibility'               
    ];

    public function candidates()
    {
        return $this->belongsToMany('App\Model\Candidate','candidate_college','college_id','candidate_id')->withPivot('code','candidate_id','college_id');
    }

    public function job_offers()
    {
        return $this->belongsToMany('App\Model\JobOffer','offer_college','college_id','job_offer_id')->withPivot('job_offer_id');
    }

    public function scopeCollege_career($query, $parametro)
    {
        if ($parametro) 
			return $query->where('candidate_college.id', 'LIKE', "%".$parametro."%");   
    }

    
}
