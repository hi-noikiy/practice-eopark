<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model {

    protected $table = 'feedback';

    //白名单,支持批量赋值的字段
    protected $fillable = [
        'user_id',
        'opinion',
    ];
}
