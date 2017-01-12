<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class PropResRelationModel extends Model {
    protected $table      = 'prop_res_relation';
    public    $timestamps = false;
    protected $fillable   = [
        'prop_value_id',
        'resource_id',
        'status',
    ];

    //获取资源已拥有的属性,返回纯属性prop_value_id数组
    public static function getDataByResId($resId) {
        return PropResRelationModel::where([
            'resource_id' => $resId,
            'status' => 1
        ])->lists('prop_value_id')->toArray();
    }

    public static function addData($valueIds, $resId) {
        if (!is_array($valueIds)) {
            return false;
        }
        $insertData = [];
        foreach ($valueIds as $propValueId) {
            $data         = [
                "prop_value_id" => $propValueId,
                'resource_id' => $resId
            ];
            $insertData[] = $data;
        }
        PropResRelationModel::where("resource_id", $resId)->delete();
        return PropResRelationModel::insert($insertData);
    }
}