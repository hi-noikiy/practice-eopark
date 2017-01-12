<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class PropCateRelationModel extends Model {
    protected $table      = 'prop_cate_relation';
    public    $timestamps = false;
    protected $fillable   = [
        'category_id',
        'status',
        'prop_id',
        'prop_value_id',
    ];

    /**
     * @param $categoryId
     * @return mixed
     * 根据categoryId 获取该属性包含所有prop_value_id
     */
    public static  function getPropValueIdsByCateId($categoryId) {
        return PropCateRelationModel::where([
            'category_id' => $categoryId,
            "status" => 1
        ])->lists("prop_value_id");
    }

}