<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class PropertiesModel extends Model {
    protected $table      = 'properties';
    public    $timestamps = false;
    protected $fillable   = [
        'name',
        'status',
        'priority'
    ];

    //根据property_id 删除属性分组及其相关联数据(prop_value,prop_cate_relation,prop_res_relation)
    public static  function deleteById($id) {
        $propValueIds = PropValueModel::where("prop_id", $id)->lists("id")->toArray();
        foreach ($propValueIds as $propValueId) {
            $cateRelationIds = PropCateRelationModel::where("prop_value_id", $propValueId)->lists("id")->toArray();
            if ($cateRelationIds) {
                PropCateRelationModel::destroy($cateRelationIds);
            }
            $resRelationIds = PropResRelationModel::where("prop_value_id", $propValueId)->lists('id')->toArray();
            if ($resRelationIds) {
                PropResRelationModel::destroy($resRelationIds);
            }
        }
        PropValueModel::destroy($propValueIds);
        PropertiesModel::where('id', $id)->delete();
    }

    //获取所有属性组,及其值
    public static function getAll() {
        $properties = PropertiesModel::where("status", 1)->get();
        foreach ($properties as $key => $property) {
            $properties[$key]->values = PropValueModel::where([
                "prop_id" => $property->id,
                "status" => 1
            ])->get();
        }
        return $properties;
    }

}