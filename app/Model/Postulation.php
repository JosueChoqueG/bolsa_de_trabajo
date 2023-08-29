<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    protected $table        = 'postulation';
	protected $primaryKey   = 'id';
    public $timestamps      = true;
    protected $casts        =  [
        'id'            =>'integer',
        'job_offer_id'  =>'integer',
        'candidate_id'  =>'string',
        'status'        =>'string',

    ];
    protected $fillable = [
        'id'            =>'integer',
        'job_offer_id'  =>'integer',
        'candidate_id'  =>'string',
        'status'        =>'string',

    ];

    public function candidate()
    {
        return $this->belongsTo('App\Model\Candidate');
    }

    public function job_offer()
    {
        return $this->belongsTo('App\Model\JobOffer');
    }
}
