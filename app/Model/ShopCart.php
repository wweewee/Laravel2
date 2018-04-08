<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    public $table = 'admin_commodity';

//    2. 主键
    public $primaryKey = 'did';

//    3. 是否维护created_at updated_at字段
    public $timestamps = false;

//    4. 是否允许批量操作字段
    public $guarded = [];
}
