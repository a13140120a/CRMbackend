<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model 
{

    protected $casts = [
        'address' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
    ];
}
