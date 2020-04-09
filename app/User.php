<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_name', 'email', 'password' ,'position' ,'department_id' ,'profile_picture'
    ];

    protected $primaryKey = 'user_id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department() {
        return $this->belongsTo('App\Department', 'department_id');
    }
    public function work() {
        return $this->hasMany('App\Work', 'user_id');
    }
    public function task() {
        return $this->hasMany('App\Task', 'task_id');
    }
}
