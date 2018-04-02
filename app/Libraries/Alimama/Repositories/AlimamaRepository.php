<?php

namespace App\Libraries\Alimama\Repositories;

use App\Libraries\Alimama\Contracts\AlimamaInterface;
use App\Libraries\Alimama\SDK;

use App\Libraries\Alimama\top\domain\GenPwdIsvParamDto;
use App\Libraries\Alimama\top\domain\TopItemQuery;
use App\Libraries\Alimama\top\request\WirelessShareTpwdCreateRequest;
use App\Libraries\Alimama\top\request\TbkItemInfoGetRequest;
use App\Libraries\Alimama\top\request\TbkCouponGetRequest;
use App\Libraries\Alimama\top\request\WirelessShareTpwdQueryRequest;
use App\Libraries\Alimama\top\request\TbkDgItemCouponGetRequest;
use App\Libraries\Alimama\top\request\TbkTpwdCreateRequest;
use App\Libraries\Alimama\top\request\TbkItemGetRequest;
use App\Libraries\Alimama\top\request\JuItemsSearchRequest;

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

  // 生成淘宝客淘口令
  public function tbkTpwdCreate (Array $info)
  {
    $allInfo = [
      'url'     => '',
      'text'    => '超值活动，惊喜活动多多',
      'logo'    => '',
      'user_id' => config('alimama.id'),
      'ext'     => ''
    ];

    $req = new TbkTpwdCreateRequest;
    $req = $this->batchAssignmentSet($req, $allInfo, $info);
    return $this->taobao->execute($req);
  }

  // 淘宝客商品查询
  public function tbkItemGet (Array $info, $platform = '1', $fields = '')
  {
    $allFields = 'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,nick,seller_id,volume';
    $allRequests = [
                      'q'             => '',
                      'cat'           => '',
                      'itemloc'       => '',
                      'sort'          => '',
                      'is_tmall'      => '',
                      'is_overseas'   => '',
                      'start_price'   => '',
                      'end_price'     => '',
                      'start_tk_rate' => '',
                      'end_tk_rate'   => '',
                      'page_no'       => '',
                      'page_size'     => ''
                  ];

    $fields = $this->getRealFields($allFields, $fields);
    $platform = $this->getRealPlatForm($platform);
    $req = new TbkItemGetRequest;
    $req->setFields($fields);
    $req->setPlatform($platform);
    $req = $this->batchAssignmentSet($req, $allRequests, $info);
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

  // 推广券信息查询
  public function tbkCouponGet ($info)
  {
    $one = [
               'item_id', // 商品ID
               'activity_id' // 券ID
             ];
     $two = [
              'me',      // 带券ID与商品ID的加密串
            ];
    $req = new TbkCouponGetRequest;
    $infoKeys = array_keys($info);

    if ($infoKeys == $one || $infoKeys == $two) {
      $req = $this->setAttribute($req, $info);
      return $this->taobao->execute($req);
    } else {
      return null;
    }
  }

  // 查询解析淘口令
  public function wirelessShareTpwdQuery ($tpwd)
  {
    $req = new WirelessShareTpwdQueryRequest;
    $req->setPasswordContent($tpwd);
    return $this->taobao->execute($req);
  }

  // 好券清单API导购
  public function tbkDgItemCouponGet($info = [], $adzone_id = false)
  {
    isset($adzone_id) ? $adzone_id = config('alimama.adzone_id') : null;

    $req = new TbkDgItemCouponGetRequest;
    $req->setAdzoneId($adzone_id);
    $req = $this->setAttribute($req, $info);
    return $this->taobao->execute($req);
  }


  // 聚划算商品搜索接口
  public function juItemsSearch (Array $info)
  {
    $allInfo = [
      'current_page' => 1,
      'page_size' => 20,
      'pid' => config('alimama.ju_items_search_pid'),
      'postage' => true,
      'status' => 1,
      'taobao_category_id' => '',
      'word' => ''
    ];

    $req = new JuItemsSearchRequest;
    $tpwd_param = new TopItemQuery;
    $tpwd_param = $this->batchAssignment($tpwd_param, $allInfo, $info);
    $req->setParamTopItemQuery(json_encode($tpwd_param));
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
        if ($value !== '') {
          $obj->$key = $value;
        }
      }
    }

    return $obj;
  }

  // 给对象赋值,set形式
  public function batchAssignmentSet($obj, Array $allInfo, Array $info)
  {
    $infoKeys = array_keys($info);
    $allInfoNew = [];

    foreach ($allInfo as $key => $value) {
      if (in_array($key, $infoKeys)) {
        $allInfoNew[$key] = $info[$key];
      } elseif(!empty($value)) {
        $allInfoNew[$key] = $value;
      }
    }

    return $this->setAttribute($obj, $allInfoNew);
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

  // 给对象设置参数
  public function setAttribute($obj, $attrArr)
  {
    foreach ($attrArr as $attr => $value) {
        $setAttr = $this->attrToSnake($attr);
        $obj->$setAttr($value);
    }

    return $obj;
  }

  // 变换字符串，将aaa_bbb变成setAaaBbb的形状
  public function attrToSnake($str_str) {
    $str_str_arr = explode('_', $str_str);

    foreach ($str_str_arr as $key => $str) {
      $str_str_arr[$key] = ucfirst($str);
    }

    return 'set'.implode('', $str_str_arr);
  }
}
