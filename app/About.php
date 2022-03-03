<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'abouts';
    protected $fillable=['name','image','description','email','contact','created_at','updated_at'];
}
