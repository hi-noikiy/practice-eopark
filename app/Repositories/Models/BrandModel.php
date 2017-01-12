<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model {

    protected $table = 'brands';

    public $timestamps = false;
    //白名单,支持批量赋值的字段
    protected     $fillable = [
        'brand_name',
        'brand_logo',
        'priority',
        "status",
        "official_url"
    ];
    public static $select   = [
        'brand_name',
        'id',
        'brand_logo',
        "status",
        "official_url"
    ];

    public static function deleteById($brandId) {
        ResourcesModel::where("brand_id", $brandId)->update(["brand_id" => 0]);
        return BrandModel::where("id", $brandId)->delete();
    }

    public static function getDataByIds($brandIds) {
//        if (!count($brandIds)) {
//            return null;
//        }
        $query = BrandModel::select(self::$select)->orderBy('priority');
        foreach ($brandIds as $brandId) {
            $query->orWhere('id', $brandId);
        }
        return $query->get();
    }

}
