<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title'];
}
