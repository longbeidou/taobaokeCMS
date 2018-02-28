<?php

namespace App\Presenters;

/**
 * 一般的前端页面显示
 */
class WiewPresenter
{
  // mui的active显示
  public function muiActive($key1, $key2)
  {
    $muiActive = $key1 == $key2 ? 'mui-active' : '';

    return $muiActive;
  }
}
