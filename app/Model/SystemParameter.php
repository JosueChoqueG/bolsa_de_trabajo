<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    protected $table = 'system_parameter';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = [
        'code', 
        'description',
        'parameter_value',
    ];

    protected $casts = [
        'code' => 'string', 
        'description' => 'string',
        'parameter_value' => 'string',
    ];
}
