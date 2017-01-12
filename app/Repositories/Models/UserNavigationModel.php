<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class UserNavigationModel extends Model {

    protected $table = 'user_navigation';
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
        return UserNavigationModel::select(self::$select)->where('user_id', $userId)->get();
    }

    public static function add($data, $userId) {
        $orderId = UserNavigationModel::where("user_id", $userId)->count();
        return UserNavigationModel::create([
            'user_id' => $userId,
            'url_name' => $data["url_name"],
            'url' => $data["url"],
            'order_id' => $orderId + 1
        ]);
    }

    public static function deleteById($id) {
        UserNavigationModel::where("id", $id)->delete();
    }

}
