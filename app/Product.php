<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'images', 'car_brand_id', 'car_model_id', 'car_year_id', 'attributes', 'sku'];
}
