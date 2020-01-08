<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Disaction;

class Employee extends Model
{
    

    public function disactions(){
    	return $this->hasMany(Disaction::class);
    }
}
