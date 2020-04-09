<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'task_id';
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function work() {
        return $this->belongsTo('App\Work', 'work_id');
    }
}
