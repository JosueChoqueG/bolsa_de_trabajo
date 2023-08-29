<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailJobOffer extends Model
{
    protected $table        ='email_job_offer';
	protected $primaryKey   ='id';
    public $timestamps      = false;

    protected $casts        = [
        'id'             =>'integer',
        'job_offer_id'   =>'integer',
        'quantity'       =>'integer',
        'created_at'     =>'string',
        'user_id'        =>'integer',
    ];
    protected $fillable =[
        'id',                          
        'job_offer_id',                         
        'quantity',              
        'created_at',                
        'user_id',                                
    ];
    
    public function job_offer()
    {
        return $this->belongsTo('App\Model\jobOffer','job_offer_id');//('modelo','id forenkey de egresados','primari key provincias')
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
