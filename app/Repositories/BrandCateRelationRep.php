<?php
namespace App\Repositories;

use App\Repositories\Models\BrandCateRelationModel;

class BrandCateRelationRep {

    public static function getRelations() {
        return BrandCateRelationModel::leftJoin("brands as a", "a.id", "=", "brand_cate_relation.brand_id")->where("a.status", "1")->get();
    }

}