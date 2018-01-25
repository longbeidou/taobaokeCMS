<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminer extends Model
{
    protected $table = "adminers";

    protected $fillable = [
      'name', 'email', 'password'
    ];

    protected $hidden = [
      // 'password', 'remember_token'
    ];
}
