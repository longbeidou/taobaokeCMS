<?php

namespace App\Libraries\Alimama\Repositories;

use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Libraries\Alimama\SDK;

use App\Libraries\Alimama\top\request\WirelessShareTpwdCreateRequest;
use App\Libraries\Alimama\top\domain\GenPwdIsvParamDto;

/**
 * 淘宝客接口对应的实现
 */
class AlimamaRepository implements AlimamaInterface
{
  public $taobao;

  function __construct()
  {
    $this->taobao = SDK::api();
  }

  // 获取淘口令
  public function createShareTpwd (Array $info)
  {
    $allInfo = [
      'url'     => '',
      'text'    => '超值活动，惊喜活动多多',
      'logo'    => '',
      'user_id' => config('alimama.id'),
      'ext'     => ''
    ];

    $req = new WirelessShareTpwdCreateRequest;
    $tpwd_param = new GenPwdIsvParamDto;
    $tpwd_param = $this->batchAssignment($tpwd_param, $allInfo, $info);
    $req->setTpwdParam(json_encode($tpwd_param));
    return $this->taobao->execute($req);
  }

  // 给对象赋值
  public function batchAssignment($obj, Array $allInfo, Array $info)
  {
    $infoKeys = array_keys($info);

    foreach ($allInfo as $key => $value) {
      if (in_array($key, $infoKeys)) {
        $obj->$key = $info[$key];
      } else {
        $obj->$key = $value;
      }
    }

    return $obj;
  }
}
