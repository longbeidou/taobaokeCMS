<?php

namespace App\Http\Middleware;

use Closure;
use Excel;

class CheckCouponExcel
{
    // 允许的文件后缀
    protected $excelExtension = ['xls'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        set_time_limit(0);
        ini_set ('memory_limit', '1024M');

        // 判断是否有上传文件
        if ( $request->hasFile('excel') ) {
          $fileExtension = $request->file('excel')->getClientOriginalExtension();
          if ( in_array($fileExtension, $this->excelExtension) ) {
            $destinationPath = storage_path().'/alimama/';
            $fileName = 'coupons.'.$fileExtension;
            $request->file('excel')->move($destinationPath, $fileName);
            $num = Excel::load($destinationPath.$fileName)->takeRows(1)->first()->count();
            if ( $num == 22 ) {

              return $next($request);
            } else {

              return redirect()->route('admin.coupons.create')
                                ->withErrors('请上传列为22的Excel文件！');
            }
          } else {

            return redirect()->route('admin.coupons.create')
                              ->withErrors('请上传后缀为'.implode('、', $this->excelExtension).'的Excel文件！');
          }
        } else {

          return redirect()->route('admin.coupons.create')->withErrors('请选择文件后上传！');
        }
    }
}
