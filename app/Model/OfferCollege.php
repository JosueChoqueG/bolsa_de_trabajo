<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OfferCollege extends Model
{
    protected $table        = 'offer_college';
	protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $casts        = [
        'id'                            =>'integer',
        'id_collage'                    =>'integer',
        'id_job_offer'                  =>'integer'        
    ];

    protected $fillable =[
        'id'            ,
        'id_collage'    ,
        'id_job_offer'      
    ];

    

}
