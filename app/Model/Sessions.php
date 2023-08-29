<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $table        = 'sessions';
	protected $primaryKey   = 'id';
    public $timestamps      = false;   

    protected $casts        = [
        'user_id'     =>'integer',
        'document'    =>'string',
        'user_type'   => 'string',
        'created'     => 'date'
    ];
    protected $fillable     = [                   
        'user_id',                       
        'document',    
        'user_type',            
        'created'   
    ];
}
