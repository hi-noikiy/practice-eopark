<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class PropValueModel extends Model {
    protected $table      = 'prop_value';
    public    $timestamps = false;
    protected $fillable   = [
        'prop_id',
        'name',
        'status',
        'priority'
    ];

    public static function getDataById($id) {
        $propValue            = PropValueModel::where("id", $id)->first();
        $propValue->prop_name = PropertiesModel::where("id", $propValue->prop_id)->pluck("name")->first();
        return $propValue;
    }

    public static function deleteById($id) {
        PropCateRelationModel::where("prop_value_id", $id)->delete();
        PropResRelationModel::where('prop_value_id', $id)->delete();
        PropValueModel::where("id", $id)->delete();
    }

    /**
     * @param $propValueIds
     * @return array
     * 根据属性值propValueIds数组获取数组,并分组
     */
    public static function getPropGroupsByIds($propValueIds) {
        $result = [];
        foreach ($propValueIds as $propValueId) {
            $valueData = PropValueModel::
            leftJoin("properties", "properties.id", "=", "prop_value.prop_id")->where([
                "prop_value.id" => $propValueId,
                "prop_value.status" => 1,
                "properties.status" => 1,
            ])->select([
                'prop_value.id as value_id',
                'prop_value.name as value_name',
                'properties.id as prop_id',
                'properties.name as prop_name',
            ])->first();

            if ($valueData) {
                $valueData = $valueData->toArray();
                if (key_exists($valueData['prop_id'], $result)) {
                    $result[$valueData['prop_id']]['values'][]    = $valueData;
                    $result[$valueData['prop_id']]['value_ids'][] = $valueData["value_id"];
                } else {
                    $result[$valueData['prop_id']]              = [
                        'values' => [$valueData],
                        'value_ids' => [$valueData['value_id']]
                    ];
                    $result[$valueData['prop_id']]["prop_name"] = $valueData["prop_name"];
                }
            }
        }
        ksort($result);
        return $result;
    }


}