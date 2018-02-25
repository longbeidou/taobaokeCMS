<?php

namespace App\Libraries\Alimama\Repositories;

use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Libraries\Alimama\SDK;

use App\Libraries\Alimama\top\request\WirelessShareTpwdCreateRequest;
use App\Libraries\Alimama\top\request\TbkItemInfoGetRequest;
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
  public function wirelessShareTpwdCreate (Array $info)
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

  // 获取淘宝客商品详情（简版）信息
  public function tbkItemInfoGet ($num_iids, $platform = 1, $fields = '')
  {
    $allFields = 'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,nick,seller_id,volume,cat_leaf_name,cat_name';

    $fields = $this->getRealFields($allFields, $fields);
    $platform = $this->getRealPlatForm($platform);

    $req = new TbkItemInfoGetRequest;
    $req->setFields($fields);
    $req->setPlatform($platform);
    $req->setNumIids($num_iids);
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

  // 获取实际的请求参数
  public function getRealFields($allFields, $fields)
  {
    if (empty($fields)) {
      return $allFields;
    }

    $allFieldsArr = explode(',', $allFields);
    $fieldsArr = explode(',', $fields);
    $newFieldArr = [];

    foreach ($fieldsArr as $field) {
      in_array($field, $allFieldsArr) ? $newFieldArr[] = $field : '';
    }

    if (count($newFieldArr) == 0) {
      return $allFields;
    }

    return implode(',', $newFieldArr);
  }

  // 获取正确的平台参数
  public function getRealPlatForm($platform)
  {
    switch ($platform) {
      case '2':
        $platform = 2;
        break;

      default:
        $platform = 1;
        break;
    }

    return $platform;
  }
}
