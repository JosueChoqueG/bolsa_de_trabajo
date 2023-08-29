<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table        = 'image';
	protected $primaryKey   = 'id';
    public $timestamps      = false;
    protected $casts        = [
        'id'                            =>'integer',
        'publication_id'                =>'integer',
        'resource_id'                   =>'integer',
        'path'                          =>'string',
        'title'                         =>'string',
        'description'                   =>'string',

    ];
    protected $fillable     = [
        'id',
        'publication_id',
        'resource_id',
        'path',
        'title',
        'description'                          
    ];
    //relations

    public function publication()
    {
        return $this->belongsTo('App\Model\Publication');
    }
    
}
