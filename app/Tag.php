<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title'];
}
