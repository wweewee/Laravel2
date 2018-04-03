<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //1.模型的关联表
    public $table = 'admin_commodity';
    //2.模型的默认主键
    public $primaryKey = 'did';
    //3.是否主动维护着两个字段
    public $timestamps = false;
    // 4.是否允许批量操作(不允许批量修改的字段,不填表示没有不允许的)
    public $guarded = []; 
}
