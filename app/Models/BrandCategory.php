<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
  protected $table = "brand_categorys";

  protected $fillable = [
    'name', 'is_show', 'order', 'font_icon', 'total'
  ];

  protected $hidden = [
  ];
}
