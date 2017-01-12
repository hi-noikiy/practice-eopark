<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesModel extends Model {
    protected $table = 'categories';
    //白名单,支持批量赋值的字段
    protected $fillable = [
        'name',
        'parent_id',
        'depth',
        "priority",
        "status"
    ];

    public static $select = [
        "id",
        "name",
        "parent_id"
    ];

    /**
     * @param $var  array() 包含需要返回的分级链各个id值
     *               或int      单个id值,自行找出上级链
     * @return array|null 分级链
     */
    public static function getChainById($var) {
        $result = null;
        $return = [];
        if (is_array($var)) {
            switch (count($var)) {
                case 1:
                    $result = CategoriesModel::orWhere($var[0])->get();
                    break;
                case 2:
                    $result = CategoriesModel::orWhere($var[0])->orWhere($var[1])->get();
                    break;
                case 3:
                    $result = CategoriesModel::orWhere($var[0])->orWhere($var[1])->orWhere($var[2])->get();
                    break;
            }
            return $result;
        } else {
            $data1 = CategoriesModel::where("id", $var)->select(self::$select)->first();
            if ($data1) {
                $return[] = $data1;
                if ($data1['parent_id'] != 0) {
                    $data2 = CategoriesModel::where("id", $data1['parent_id'])->select(self::$select)->first();
                    if ($data2) {
                        $return[] = $data2;
                        if ($data2['parent_id'] != 0) {
                            $data3 = CategoriesModel::where("id", $data2['parent_id'])->select(self::$select)->first();
                            if ($data3) {
                                $return[] = $data3;
                            }
                        }
                    }
                }
                return array_reverse($return);
            }
            return $return;
        }
    }


    public static function getChildrenChain($parentIds) {
        if (is_array($parentIds)) {
            $returnData = array();
            foreach ($parentIds as $key1 => $value1) {
                $returnData[] = CategoriesModel::select(self::$select)->where("parent_id", $value1)->orderBy("priority", "asc")->get();
                foreach ($returnData[$key1] as $key2 => $value2) {
                    $returnData[$key1][$key2]["nextChildren"] = CategoriesModel::select(self::$select)->where("parent_id", $value2["id"])->orderBy("priority", "asc")->get();
                }
            }
            return $returnData;
        } else {
//            $returnData[] = $this->getChild($parentIds);
//            foreach ($returnData[$key1] as $key2 => $value2) {
//                $returnData[$key1][$key2]["nextChildren"] = CategoriesModel::select($this->select)->where("parent_id", $value2["id"])->orderBy("priority", "asc")->get();
//            }
        }
        return false;
    }

    public static function getChildren($id) {
        return CategoriesModel::select(self::$select)->where("parent_id", $id)->orderBy("priority", "asc")->get();
    }

    public static function getSelfAndChildren($categoryId) {
        $self     = self::getSelf($categoryId);
        $children = self::getChildren($categoryId);
        if (count($children)) {
            foreach ($children as $key => $child) {
                $children[$key]->next = self::getChildren($child->id);
            }
        }
        $self->next = $children;
        return $self;
    }

    public static function getSelf($categoryId) {
        return CategoriesModel::select(self::$select)->where("id", $categoryId)->first();
    }

    public static function getDataByParentId($parentId, $status = false) {
        $where = ["parent_id" => $parentId,];
        if ($status !== false) {
            $where['status'] = $status;
        }
        return CategoriesModel::where($where)->select([
            "id",
            "name",
            "parent_id",
            "priority",
            "status",
        ])->orderBy("priority", "asc")->get();
    }

}