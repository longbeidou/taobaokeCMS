<?php
namespace App\Traits;

/**
 * 加密或者解密图片地址
 */
trait EncryptOrDecryptImage
{
  public $str = 'qiniuyun';

  // 加密图片地址
  function encryptImage($imagePath)
  {
    $imageEncryptPath = base64_encode($imagePath);
    $prifixStr = $this->prifixStr();

    return $prifixStr.$imageEncryptPath;
  }

  // 解密图片地址
  function decryptImage($imagePath)
  {
    $prifixStr = $this->prifixStr();
    $num = strlen($prifixStr);

    return base64_decode(substr($imagePath, $num));
  }

  // 设置加密的前缀
  function prifixStr ()
  {
    $strEncrypt = base64_encode($this->str);

    return $strEncrypt.substr($strEncrypt, 0, 3);
  }
}
