<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $primaryKey = 'work_id';
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function department() {
        return $this->belongsTo('App\Department','department_id');
    }
    public function task() {
        return $this->hasMany('App\Task', 'task_id');
    }
}
