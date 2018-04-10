<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function upload(Request $request)
    {


        //请求中是否携带上传文件
        if($request->hasFile('file_upload')){
            //获取上传文件
            $file = $request->file('file_upload');
            //判断上传文件的有效性
            if($file->isValid()){
                $entension = $file->getClientOriginalExtension();//上传文件的后缀名
                //生成新的唯一上传文件名
                $newName = md5(date('YmdHis').mt_rand(1000,9999).uniqid()).'.'.$entension;
                //将文件移动到指定的位置
                $path = $file->move(public_path().'\uploads',$newName);
                //返回上传的文件在服务器上的保存路径，给浏览器显示上传图片
                $filepath = '/uploads'.'/'.$newName;
                return  $filepath;
            }
        }
    }
}
