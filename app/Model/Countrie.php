<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    protected $table        = 'countrie';
	protected $primaryKey   = 'id';
    public $timestamps      = false;
    
    protected $casts        = [
        'id'    =>'integer',
        'iso'   =>'string',
        'name'  =>'string',
    ];

    protected $fillable       =[
        'id'    =>'integer',
        'iso'   =>'string',
        'name'  =>'string',
    ];
    //relations
    public function job_offers()
    {
        return $this->hasMany('App\Model\JobOffer','countrie_id', 'id');
    }
}
