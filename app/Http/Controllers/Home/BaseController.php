<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SourceOfAccess;

class BaseController extends Controller
{
  use SourceOfAccess;

  public static $from;
  public static $fromArr = ['pc','wechat','qq','wx'];

  public function __construct(Request $request)
  {
    self::$from = $this->from();
    self::$from = in_array($request->from, self::$fromArr) ? $request->from : self::$from;
  }

  public function __construct_base(Request $request)
  {
    self::$from = $this->from();
    self::$from = in_array($request->from, self::$fromArr) ? $request->from : self::$from;
  }
}
