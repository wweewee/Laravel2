<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    //让当前的show模型和表产生关联
    public $table = 'rotation';
    //定义关联表的主键
    public $primaryKey = 'id';
    //不允许批量修改的字段
    public $guarded = [];
}
