<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CarModel extends Model
{
    protected $fillable = ['name', 'slug', 'car_brand_id'];
}
