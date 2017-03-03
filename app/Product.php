<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Product Mass Assigment

    protected $fillable = ['name','image','price','description'];
}
