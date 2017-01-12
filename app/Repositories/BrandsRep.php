<?php
namespace App\Repositories;

use App\Repositories\Models\BrandModel;
use App\Repositories\Models\ResourcesModel;

class BrandsRep {

    /**
     * 根据ids获取brand
     * @param $brandIds
     * @return mixed
     */
    public static function getByBrandIds($brandIds) {
        $query             = BrandModel::select(BrandModel::$select)->orderBy("priority", "asc")->groupBy("id");
        $orWhere["status"] = 1;
        foreach ($brandIds as $brandId) {
            $orWhere['id'] = $brandId;
            $query->orWhere($orWhere);
        }
        return $query->get();
    }
}
