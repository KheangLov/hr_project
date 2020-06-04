<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'department_id'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}
