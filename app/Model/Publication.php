<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use SoftDeletes;
    protected $table        = 'publication';
    protected $dates        = ['deleted_at'];
	protected $primaryKey   = 'id';
    public $timestamps      = true;

    protected $casts        =  [
        'id'            =>'integer',
        'user_id'       =>'integer',
        'type'          =>'string',
        'title'          =>'string',
        'description'   =>'string',
        'status'        =>'string',
        'path_image'    =>'string',
        'path_pdf'      =>'string',
        'path_doc'      =>'string',
        'event_date'    =>'string',
        'start_time'    =>'string',
        'end_time'      =>'string',
        'cost'          =>'float',
        'order'         =>'integer',
        'slug'          =>'string'    

    ];
    protected $fillable = [
        'id',
        'user_id',
        'title'  ,
        'description',
        'type' ,
        'status',
        'path_image',
        'path_pdf',
        'path_doc',
        'event_date',
        'start_time',
        'end_time',
        'cost',
        'order',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function scopeTitle($query, $parametro)
    {
        if ($parametro) 
			return $query->where('title', 'LIKE', "%".$parametro."%");   
    }

}
