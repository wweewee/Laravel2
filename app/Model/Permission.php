<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //1.模型的关联表
    public $table = 'permission';
    //2.模型的默认主键
    public $primaryKey = 'id';
    //3.是否主动维护着两个字段
    public $timestamps = false;
    // 4.是否允许批量操作
    public $guarded = [];
    
}
