<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table        = 'area';
	protected $primaryKey   = 'id';
    public $timestamps      = false;
    protected $casts        = [
        'id'                            =>'integer',
        'name'                          =>'string',

    ];
    protected $fillable     = [
        'id'                            =>'integer',
        'name'                          =>'string',
    ];
    //relations
    public function job_offers()
    {
        return $this->hasMany('App\Model\JobOffer','area_id', 'id');
    }
}
