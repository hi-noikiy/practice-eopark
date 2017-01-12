<?php
namespace App\Repositories;

use App\Repositories\Models\CollectsModel;

class CollectsRep {

    public static function getCollectsByUserId($userId) {
        $select = [
            "collects.id",
            'collects.created_at',
            'resources.id As resource_id',
            'resources.title'
        ];
        return CollectsModel::select($select)->leftJoin("resources", "resources.id", '=', 'collects.resource_id')
                            ->where("user_id", $userId)->orderBy('created_at', 'desc')->get();

    }
}