<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Nestable\NestableTrait;


class Location extends \Eloquent {

    use NestableTrait;

    protected $fillable = ['parent_id','name', 'slug'];

    protected $parent = 'parent_id';

}