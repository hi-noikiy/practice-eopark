<?php
namespace App\Http\Controllers;

use App\Repositories\CollectsRep;
use App\Repositories\Models\CollectsModel;

class CollectController extends Controller {

    public function index() {
        $userId = self::getUserId(true);
        return view('collect', ['collects' => CollectsRep::getCollectsByUserId($userId)]);
    }

    public function delete($collectId) {
        if (!self::getUserId()) {
            return response("NOT_LOGIN");
        }
        return CollectsModel::deleteById($collectId);
    }

    public function add($resourceId) {
        return CollectsModel::add([
            'user_id' => self::getUserId(true),
            'resource_id' => $resourceId
        ]);
    }

}

