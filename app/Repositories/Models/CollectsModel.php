<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class CollectsModel extends Model {

    protected $table = 'collects';

    //白名单,支持批量赋值的字段
    protected $fillable = [
        'user_id',
        'url_name',
        'url',
        "order_id"
    ];

    public static $select = [
        'id',
        "url_name",
        'url',
        'x',
        'y',
        'width',
        'height',
    ];

    public static function getByUserId($userId) {
        return CollectsModel::select(self::$select)->where('user_id', $userId)->get();
    }

    public static function add($data, $userId) {
        $orderId = CollectsModel::where("user_id", $userId)->count();
        return CollectsModel::create([
            'user_id' => $userId,
            'url_name' => $data["url_name"],
            'url' => $data["url"],
            'order_id' => $orderId + 1
        ]);
    }

    public static function deleteById($id) {
        CollectsModel::where("id", $id)->delete();
    }

}
