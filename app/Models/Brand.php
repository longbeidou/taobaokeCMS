<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = "brands";

  protected $fillable = [
    'name', 'order', 'brand_category_id', 'keywords', 'is_show', 'image', 'total'
  ];

  protected $hidden = [
  ];
}
