<?php
namespace App\Repositories\Models;
use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model {

    protected $table = 'comments';

    //白名单,支持批量赋值的字段
    protected $fillable = ['user_id', 'reply', 'comment',"resource_id","status"];
}
