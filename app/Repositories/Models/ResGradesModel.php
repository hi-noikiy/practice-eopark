<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class ResGradesModel extends Model {

    //表名
    protected $table = 'res_grades';

    //白名单,支持批量赋值的字段
    protected $fillable = [
        'user_id',
        'resource_id',
        'grade'
    ];
}

