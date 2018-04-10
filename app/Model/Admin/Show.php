<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    public $table = 'rotation';
    public $primaryKey = "id";
    public $guarded=[];
    public $timestamps = false;
}
