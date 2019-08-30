<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CarYear extends Model
{
    protected $fillable = ['name', 'slug', 'car_model_id'];
}
