<?php
namespace App\Repositories;

use App\Repositories\Models\CommentsModel;

class CommentsRep {

//    public function add($data) {
//        return CommentsModel::create([
//            "user_id" => $data["userId"],
//            "replay" => $data["replay"],
//            "comment" => $data["comment"],
//            "resource_id" => $data["resource_id"],
//        ]);
//    }

//    public function getCommentsByResourceId($resourceId,$userId) {
//
//        $comments = CommentsModel::where("resource_id", $resourceId)
//            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
//            ->select("comments.*","users.name")
//            ->limit(5)->get();
//        foreach ($comments as $key=>$value){
//            if(strpos($value['likes_user_id'], ",{$userId},") === false){
//                $value['likes_user_id'] = false;
//            }else{
//                $value['likes_user_id'] = true;
//            }
//        }
//        return $comments;
//        //判断likes_user_id 字符串中是否包含当前用户
//        //SELECT find_in_set('14',(select likes_user_id from eo_comments where id= 1)) ;
//    }

}