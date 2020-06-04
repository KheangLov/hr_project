<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'unit_id'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
