<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    public function assignee()
    {
        return $this->belongsTo('App\User', 'assignee');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
