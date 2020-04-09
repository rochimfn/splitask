<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'department_id';
    public function users() {
        return $this->hasMany('App\User','department_id');
    }
    public function works() {
        return $this->hasMany('App\Work', 'department_id');
    }
}
