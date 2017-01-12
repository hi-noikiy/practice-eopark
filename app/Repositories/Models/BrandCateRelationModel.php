<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCateRelationModel extends Model {

    protected $table = 'brand_cate_relation';

    public $timestamps = false;
    //白名单,支持批量赋值的字段
    protected $fillable = [
        'brand_id',
        'category_id',
    ];

    /**
     * @param $categoryId
     * @return mixed
     * 根据传入的category分级链,获取链中每个category_id有关的brand_id
     */
    public static function getBrandIdsByCateIdChain($categoryId) {
        $query = BrandCateRelationModel::orderBy("brand_id");
        $query->orWhere("category_id", $categoryId->id);
        if (isset($categoryId->next) && count($categoryId->next)) {
            foreach ($categoryId->next as $next1) {
                $query->orWhere("category_id", $next1->id);
                if (isset($next1->next) && count($next1->next)) {
                    foreach ($next1->next as $next2) {
                        $query->orWhere("category_id", $next2->id);
                    }
                }
            }
        }
        return $query->lists("brand_id");
    }
}
