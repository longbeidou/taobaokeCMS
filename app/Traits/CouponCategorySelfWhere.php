<?php
namespace App\Traits;

/**
 * 合成或分解优惠券分类关键词对应的字符串
 */
trait CouponCategorySelfWhere
{
  public $groupAdd = '+or+'; // 连接商品组的符号
  public $cateAndWord = '+=+'; // 连接分类和商品的符号
  public $cateWordToCateWord = '+and+'; // 分类和商品组合之间的链接符号
  
  // 组合分类条件字符串
  public function makeCategoryString (Array $group1, Array $group2)
  {
    $group1Str = $this->getWhereStr($group1);
    $group2Str = $this->getWhereStr($group2);

    if (!empty($group1Str) && !empty($group2Str)) {
      return $group1Str.$this->groupAdd.$group2Str;
    }

    return (String)$group1Str.(String)$group2Str;
  }

  // 根据self_where来进行的查询条件
  public function selfWhere($self_where, $coupon)
  {
    $cateWordGroup = $this->makeSelfWhereToArray($self_where);

    if (empty($cateWordGroup)) {
      return $coupon;
    }

    foreach ($cateWordGroup as $num => $cateToWordArr) {
      if ($num == 0) {
        foreach ($cateToWordArr as $cateToWord) {
          foreach ($cateToWord as $cate => $word) {
            $coupon = $coupon->where($cate, 'like', $word);
          }
        }
      } elseif ($num == 1) {
        $coupon = $coupon->orWhere(function ($query) use($cateToWordArr) {
          foreach ($cateToWordArr as $cateToWord) {
            foreach ($cateToWord as $cate => $word) {
              $query = $query->where($cate, 'like', $word);
            }
          }
        });
      }
    }

    return $coupon;
  }

  // 将数组的各元素组合成为搜索条件的字符串
  public function getWhereStr (Array $group) {
    $array = [];
    foreach ($group as $value) {
      if (!empty($value['cate']) && !empty($value['word'])) {
        $array[] = $value['cate'].$this->cateAndWord.$value['word'];
      }
    }

    if (!empty($array)) {
      return implode($this->cateWordToCateWord, $array);
    }

    return '';
  }

  // 将查询字符串转变成数组
  public function makeSelfWhereToArray(string $self_where)
  {
    if (empty($self_where)) {
      return [];
    }

    $cateToWordArr = [];
    $selfWhereArray = explode($this->groupAdd, $self_where);

    foreach ($selfWhereArray as $i => $cateWordGroup) {
      $cateWordArr = explode($this->cateWordToCateWord, $cateWordGroup);
      foreach ($cateWordArr as $j => $cateWord) {
        $cateAndWordArr = explode($this->cateAndWord, $cateWord);
        $cateToWordArr[$i][$j][$cateAndWordArr[0]] = $cateAndWordArr[1];
      }
    }

    return $cateToWordArr;
  }
}
