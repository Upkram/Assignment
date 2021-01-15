<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questionss';
    // protected $fillable = ['name','options','correct_option','quiz','points'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
