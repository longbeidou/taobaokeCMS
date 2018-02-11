<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\EncryptOrDecryptImage;

class ImageControloer extends Controller
{
    use EncryptOrDecryptImage;

    // 返回图片的资源
    public function index (Request $request)
    {
      $image = $request->image;
      $imageNew = $this->decryptImage($image);
      $this->headerLocation($imageNew);
    }

    // header跳转返回
    public function headerLocation($image)
    {
      header('Content-type:image/jpg');
      header('Location:'.$image);
      die(0);
    }

    // header获取图片后返回
    public function headerGetImage($PE_imgpath)
    {
        $PE_imgarray = pathinfo($PE_imgpath);
        $iconcontent = file_get_contents($PE_imgpath);
        header("Content-type: image/" . $PE_imgarray["extension"]);
        header('Content-length: ' . strlen($iconcontent));
        echo $iconcontent;
        die(0);
    }
}
