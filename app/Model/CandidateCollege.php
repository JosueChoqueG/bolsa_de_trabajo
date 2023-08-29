<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateCollege extends Model
{
    protected $table        ='candidate_college';
	protected $primaryKey   ='id';
    public $timestamps      = true;
    protected $casts        = [
        'id'                            =>'integer',
        'code'                          =>'string',
        'candidate_id'                  =>'integer',
        'college_id'                    =>'integer',
    ];
    protected $fillable =[
        'id',                          
        'code',                                           
        'candidate_id',                
        'college_id',
        'academic_situation',                 
    ];
    
    public function candidate()
    {
        return $this->belongsTo('App\Model\Candidate','candidate_id');//('modelo','id forenkey de egresados','primari key provincias')
    }
   
    public function college_career()
    {
        return $this->belongsTo('App\Model\CollegeCareer','college_id');//('modelo','id forenkey de egresados','primari key provincias')
    } 
}
