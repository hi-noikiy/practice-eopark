<?php
namespace App\Http\Controllers;

use App\Repositories\CollectsRep;
use App\Repositories\Models\CollectsModel;

class MyCollectController extends Controller {

    public function index() {
        $userId = self::getUserId(true);
        return view('my_collect', ['collects' => CollectsRep::getCollectsByUserId($userId)]);
    }

    public function delete($collectId) {
        if (!self::getUserId()) {
            return response("NOT_LOGIN");
        }
        return CollectsModel::deleteById($collectId);
    }

    public function add($resourceId) {
        $userId = self::getUserId();
        if (!$userId) {
            return "NOT_LOGIN";
        }
        return CollectsModel::add([
            'user_id' => $userId,
            'resource_id' => (int)$resourceId
        ]);
    }

}

