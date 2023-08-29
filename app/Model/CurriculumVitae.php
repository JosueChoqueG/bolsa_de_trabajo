<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    protected $table        ='curriculum_vitae';
	protected $primaryKey   ='id';
    public $timestamps      = true;

    protected $casts        = [
        'id'                            =>'integer',
        'candidate_id'                  =>'integer',
        'name'                          =>'string',
        'path'                          =>'string',
        'status'                        =>'string',
    ];
    protected $fillable =[
        'id',                          
        'candidate_id',                         
        'name',              
        'path',                
        'status',                                
    ];
    
    public function candidate()
    {
        return $this->belongsTo('App\Model\Candidate','candidate_id');//('modelo','id forenkey de egresados','primari key provincias')
    }
}
