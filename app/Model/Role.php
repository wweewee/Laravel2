<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //    1. 模型关联的数据表
    public $table = 'role';

//    2. 主键
    public $primaryKey = 'id';

//    3. 是否维护created_at updated_at字段
    public $timestamps = false;

//    4. 是否允许批量操作字段
    public $guarded = [];
    
    // 定义跟权限模型关联的属性
    public function permission()
    {
        return $this->belongsToMany('App\Model\Permission','role_permission','role_id','permission_id');
    }
}
