<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Huo extends Model
{
    public $table = 'admin_activity';
    public $primaryKey = "id";
    public $timestamps = false;
    public $guarded=[];
}
