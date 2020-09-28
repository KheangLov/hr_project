<?php

namespace App;

use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name_khmer',
        'gender',
        'dob',
        'status',
        'id_card',
        'annual_leave',
        'bank_account',
        'salary',
        'start_date',
        'end_date',
        'phone',
        'address',
        'contact',
        'emer_contact_name',
        'emer_contact_relation',
        'emer_contact_phone',
        'hobby',
        'contract',
        'profile',
        'home_town',
        'self_intro',
        'goal',
        'education',
        'supervisor_id',
        'department_id',
        'position_id',
        'unit_id',
        'group_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    public function clickAttendances()
    {
        return $this->hasMany('App\ClickAttendance');
    }
}
