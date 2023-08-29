<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table        = 'sector';
	protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $casts        = [
        'id'            =>'integer',
        'name'          =>'string',
        'candidate_id'  =>'string'

    ];
    
    public function employers()
    {
        return $this->hasMany('App\Model\Employer','sector_id');
    }
}
