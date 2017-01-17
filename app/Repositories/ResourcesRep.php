<?php
namespace App\Repositories;

use App\Repositories\Models\ResourcesModel;
use Hamcrest\SelfDescribing;
use Illuminate\Support\Facades\DB;

class ResourcesRep {
    public static function getHot() {
        $selectStr =
            " eo_resources.id,title,cover,views,score,type,introduce,category_1,category_2,category_3,eo_resources.updated_at,comment_numbers ";
        $result    = [];
        for ($i = 1; $i < 4; $i++) {
//        $i=2;
            $result[$i] = ResourcesModel::leftJoin('categories as a', function ($join) {
                $join->on("resources.category_1", '=', 'a.id');
            })->leftJoin('categories as b', function ($join) {
                $join->on("resources.category_2", '=', 'b.id');
            })->leftJoin('categories as c', function ($join) {
                $join->on('resources.category_3', '=', "c.id");
            })->selectRaw($selectStr)->where([
                'resources.type' => $i,
                "resources.status" => 1,
                //                "a.status" => 1,
                //                "b.status" => 1,
                //                "c.status" => 1,
                // 如果注释资源所属分类已经关闭,该分类下资源仍会被正常查找
                //如果不注释,category_3或category_2值为0的资源无法被判定为c.status=1,无法找出
            ])->orderBy("views","desc")->limit(10)->get();
        }
        return $result;
    }

//
//    public function getByCategoryId($categoryId) {
//        $resources = array();
//        for ($i = 1; $i < 4; $i++) {
//            $resource    = ResourcesModel::select($this->selectArr)->orWhere([
//                "category_1" => $categoryId,
//                "status" => 1,
//                "type" => $i
//            ])->orWhere([
//                "category_2" => $categoryId,
//                "status" => 1,
//                "type" => $i
//            ])->orWhere([
//                "category_3" => $categoryId,
//                "status" => 1,
//                "type" => $i
//            ])->limit(5)->get();
//            $resources[] = $resource;
//        }
//        return $resources;
//    }
//

//
//    //前台thanksgiving
//    public function addResource($userId, $data) {
//        if (!preg_match("/^http:\/\//i", $data['link']) && !preg_match("/^https:\/\//i", $data['link'])) {
//            $data['link'] = "http://" . $data['link'];
//        }
//        return ResourcesModel::create(array(
//            'title' => $data['title'],
//            'introduce' => $data['introduce'],
//            'cover' => $data['cover'],
//            'author' => $data['author'],
//            'type' => $data['type'],
//            'category' => $data['category1'],
//            'link' => $data['link'],
//            'contributor' => $userId,
//        ));
//    }
//
//    //后台添加
//    public function add($data) {
//        return ResourcesModel::create($data);
//    }
//
//    public function getOne($id) {
//        return ResourcesModel::where("id", $id)->first();
//    }
//
//    public function getAll() {
//        $resources = ResourcesModel::orderBy('id', 'desc')->paginate(15);
//        return $resources;
//    }
//
//    public function deleteById($id) {
//
//    }
//
//    public function edit($id, $data) {
//        ResourcesModel::where("id", $id)->update($data);
//    }

}