<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table      = 'resource';
    public $timestamps    = true;
    
    protected $fillable = [
        'type', 
        'name',
        'path', 
    ];

    protected $casts = [
        'type' => 'string', 
        'name' => 'string',
        'path' => 'string', 
    ];
    //relations


    public function scopeParametro($query, $parametro)
    {
        if ($parametro->slc_search == 'name') 
            return $query->where('name', 'LIKE', "%".$parametro->parameter."%");   

        if ($parametro->slc_search == 'created_at') 
            return $query->where('created_at', 'LIKE', "%".$parametro->parameter."%"); 
            
    }
}
