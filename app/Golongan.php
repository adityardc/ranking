<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Golongan extends Model
{
    use SoftDeletes;

    public function mkgs()
    {
        return $this->hasMany('App\Mkg');
    }
}
