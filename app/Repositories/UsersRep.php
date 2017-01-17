<?php
namespace App\Repositories;

use App\Repositories\Models\UsersModel;

class UsersRep {

//    public function add($data) {
//        return UsersModel::create([
//            "name" => $data["userName"],
//            "password" => $data["password"],
//            "email" => $data["userName"],
//        ]);
//    }
    public static function getAll($name) {
        if($name){
            $members = UsersModel::where("name",$name)->orderBy('id', 'desc')->paginate(15);
        }else{
            $members = UsersModel::orderBy('id', 'desc')->paginate(15);
        }
        return $members;
    }
//

//    public function getOne($id) {
//        return UsersModel::where("id", $id)->first();
//    }

}