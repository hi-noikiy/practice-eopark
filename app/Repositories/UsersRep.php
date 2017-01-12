<?php
namespace App\Repositories;

use App\Repositories\Models\UsersModel;

class UsersRepository {

//    public function add($data) {
//        return UsersModel::create([
//            "name" => $data["userName"],
//            "password" => $data["password"],
//            "email" => $data["userName"],
//        ]);
//    }
    public function getAll($name) {
        if($name){
            $members = UsersModel::where("name",$name)->orderBy('id', 'desc')->paginate(15);
        }else{
            $members = UsersModel::orderBy('id', 'desc')->paginate(15);
        }
        return $members;
    }
//
//    public function deleteById($id) {
//        UsersModel::where("id", $id)->delete();
//    }
//    public function getOne($id) {
//        return UsersModel::where("id", $id)->first();
//    }
//    public function edit($id, $data) {
//        UsersModel::where("id", $id)->update($data);
//    }
}