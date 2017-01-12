<?php
namespace App\Repositories;

use App\Http\Controllers\Admin\HelperController;
use App\Repositories\Models\FoldersModel;
use App\Repositories\Models\CategoriesModel;
use App\Repositories\Models\PropCateRelationModel;

class CategoriesRep {

//    protected $SELECT = [
//        'id',
//        'name',
//        'parent_id'
//    ];
//
//    public function add($id, $name, $type = "child") {
//        $parent = CategoriesModel::select([
//            "parent_id",
//            "depth"
//        ])->where("id", $id)->first();
//        if ($type == "brother") {
//            $count      = CategoriesModel::where("parent_id", $parent->parent_id)->count();
//            $returnData = CategoriesModel::create([
//                "name" => $name,
//                "parent_id" => $parent->parent_id,
//                "depth" => $parent->depth,
//                "priority" => $count + 1
//            ]);
//        } else {
//            $count      = CategoriesModel::where("parent_id", $id)->count();
//            $returnData = CategoriesModel::create([
//                "name" => $name,
//                "parent_id" => $id,
//                "depth" => $parent->depth,
//                "priority" => $count + 1
//            ]);
//        }
//        return $returnData;
//    }
//
//
//
//    public function getChildren($parentIds) {
//        $select = [
//            "id",
//            "parent_id",
//            "name"
//        ];
//        if (is_array($parentIds)) {
//            $returnData = array();
//            foreach ($parentIds as $key1 => $value1) {
//                $returnData[] = CategoriesModel::select($select)->where("parent_id", $value1)->orderBy("priority", "asc")->get();
//                foreach ($returnData[$key1] as $key2 => $value2) {
//                    $returnData[$key1][$key2]["nextChildren"] = CategoriesModel::select($select)->where("parent_id", $value2["id"])->orderBy("priority", "asc")->get();
//                }
//            }
//            return $returnData;
//        } else {
//        }
//        return false;
//    }
//
//    public function changeName($id, $name) {
//        CategoriesModel::where("id", $id)->update(["name" => $name]);
//    }
//
//    public function delete($id) {
//        $deleteIds = [];
//        $parent    = CategoriesModel::select([
//            "parent_id",
//            "priority"
//        ])->where("id", $id)->first();
//        //更新所在级别优先级排序
//        if ($parent) {
//            CategoriesModel::where("parent_id", $parent->parent_id)->where("priority", ">", $parent->priority)->decrement('priority');
//        }
//        //删除子一级数据
//        $results = CategoriesModel::select(["id"])->where("parent_id", $id)->get();
//        if (!$results->isEmpty()) {
//            foreach ($results as $item) {
//                //删除子二级数据
//                $deleteIds[] = $item->id;
//                $result2     = CategoriesModel::select(["id"])->where("parent_id", $item->id)->get();
//                if (!$result2->isEmpty()) {
//                    foreach ($result2 as $item2) {
//                        $deleteIds[] = $item2->id;
//                    }
//                }
//            }
//        }
//        $deleteIds[] = $id;
//        //删除prop_cate_relation 表中数据
//        foreach ($deleteIds as $deleteId) {
//            PropCateRelationModel::where("category_id", $deleteId)->delete();
//        }
//        return CategoriesModel::destroy($deleteIds);
//    }
//
//    public function up($id) {
//        $idArr = $this->getData($id);
//        CategoriesModel::where([
//            "parent_id" => $idArr['parent_id'],
//            "priority" => $idArr["priority"] - 1
//        ])->increment('priority');
//
//        CategoriesModel::where("id", $id)->decrement('priority');
//    }
//
//    public function down($id) {
//        $idArr = $this->getData($id);
//        CategoriesModel::where([
//            "parent_id" => $idArr['parent_id'],
//            "priority" => $idArr["priority"] + 1
//        ])->decrement('priority');
//        CategoriesModel::where("id", $id)->increment('priority');
//
//    }
//
//    protected function getData($id) {
//        return CategoriesModel::select([
//            "parent_id",
//            "priority"
//        ])->where("id", $id)->first();
//    }
//
//    public function getAll() {
//        $returnData = CategoriesModel::select($this->SELECT)->where("parent_id", 0)->orderBy("priority", "asc")->get();
//        foreach ($returnData as $key1 => $value1) {
//            $returnData[$key1]["nextChildren"] = CategoriesModel::select($this->SELECT)->where("parent_id", $value1['id'])->orderBy("priority", "asc")->get();
//            foreach ($returnData[$key1]["nextChildren"] as $key2 => $value2) {
//                $returnData[$key1]["nextChildren"][$key2]["nextChildren"] = CategoriesModel::select($this->SELECT)->where("parent_id", $value2["id"])->orderBy("priority", "asc")->get();
//            }
//        }
//        return $returnData;
//    }
//
//    public function getParentsById($id) {
//        $select     = [
//            "id",
//            "parent_id",
//            "name",
//            "depth"
//        ];
//        $returnData = array();
//        $parent1    = CategoriesModel::select($select)->where("id", $id)->first();
//
//        $returnData[$parent1->depth] = $parent1;
//        if ($parent1->parent_id != 0) {
//            $parent2                     = CategoriesModel::select($select)->where("id", $parent1->parent_id)->first();
//            $returnData[$parent2->depth] = $parent2;
//            if ($parent2->parent_id != 0) {
//                $parent3                     = CategoriesModel::select($select)->where("id", $parent2->parent_id)->first();
//                $returnData[$parent3->depth] = $parent3;
//            }
//        }
//        return $returnData;
//    }


}