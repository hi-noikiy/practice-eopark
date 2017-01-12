<?php
namespace App\Common\Traits;

use App\Repositories\Models\CategoriesModel;
use App\Repositories\Models\PropCateRelationModel;
use Illuminate\Support\Facades\DB;

trait UpdateCacheTrait {

    /**
     * @param bool $statusFilter
     * @return array 缓存category分级链路
     * 缓存category分级链路
     */
    private function updateCategories($statusFilter = false) {
        $levelOnes = CategoriesModel::getDataByParentId(0, $statusFilter)->toArray();
        $result    = array();
        if (count($levelOnes)) {
            foreach ($levelOnes as $levelOne) {
                $result[$levelOne['id']] = $levelOne;
                $levelTwos               = CategoriesModel::getDataByParentId($levelOne['id'], $statusFilter)->toArray();
                if (count($levelTwos)) {
                    $level2Arr = array();
                    foreach ($levelTwos as $levelTwo) {
                        $level2Arr[$levelTwo["id"]] = $levelTwo;
                        $levelThrees                = CategoriesModel::getDataByParentId($levelTwo['id'], $statusFilter)->toArray();
                        if (count($levelTwos)) {
                            $level3Arr = array();
                            foreach ($levelThrees as $levelThree) {
                                $level3Arr[$levelThree["id"]] = $levelThree;
                            }
                            $level2Arr[$levelTwo["id"]]['next'] = $level3Arr;
                        } else {
                            $level2Arr[$levelTwo["id"]]['next'] = [];
                        }
                    }
                    $result[$levelOne['id']]['next'] = $level2Arr;
                } else {
                    $result[$levelOne['id']]['next'] = [];
                }
            }
        }
        if ($statusFilter === false) {
            //包括已隐藏数据
            $categoriesFilePath = base_path('database/helpers/category_all.php');
        } else {
            //只包括status=1状态的数据
            $categoriesFilePath = base_path('database/helpers/category.php');
        }
        file_put_contents($categoriesFilePath, serialize($result));
        return $result;
    }


    /**
     * @return bool
     * 缓存分类链路下热门资源
     * 用于前台路由/category/getResource中需要获取的数据
     */
    public function updateResources() {
        //获取所有分类
        $categories = getCategoryCache();
        foreach ($categories as $key1 => $category1) {
            $categories[$key1]['resource'] = $this->packageData(1, $category1['id']);
            if (!isset($category1['next']) && !count($category1['next'])) {
                continue;
            } else {
                foreach ($category1['next'] as $key2 => $category2) {
                    $categories[$key1]['next'][$key2]['resource'] = $this->packageData(2, $category2['id']);
                    if (!isset($category2['next']) && !count($category2['next'])) {
                        continue;
                    } else {
                        foreach ($category2['next'] as $key3 => $category3) {
                            $categories[$key1]['next'][$key2]['next'][$key3]['resource'] = $this->packageData(3, $category3['id']);
                        }
                    }
                }
            }
        }
        return file_put_contents(config("path.resources"), serialize($categories)) ? true : false;
    }

    private function packageData($depth, $categoryId) {

        $result          = array();
        $result['type1'] = $this->doSelect($depth, $categoryId, 1);
        $result['type2'] = $this->doSelect($depth, $categoryId, 2);
        $result['type3'] = $this->doSelect($depth, $categoryId, 3);
        return $result;
    }

    private function doSelect($categoryDepth, $categoryId, $type) {
        $where      = " category_{$categoryDepth}={$categoryId} and type = {$type} and status = 1";
        $order      = " ORDER BY views desc limit 8";
        return  DB::select(" SELECT *  FROM eo_resources WHERE {$where}{$order}");
    }


    /**
     * 缓存分类下包含属性关系
     * 用于thanksgiving中获取当前分类下的属性列表
     */
    public function updateCatePropRelation() {
        $select    = [
            "prop_cate_relation.category_id",
            "prop_cate_relation.prop_value_id",
            "prop_value.name as prop_value_name",
            "properties.name as prop_name",
            "properties.id as prop_id",
        ];
        $relations = PropCateRelationModel::select($select)->leftJoin('prop_value', 'prop_value.id', "=", 'prop_cate_relation.prop_value_id')->leftJoin('properties', 'properties.id', "=", 'prop_value.prop_id')->where("prop_cate_relation.status", 1)->orderBy("properties.priority", "asc")->get()->toArray();
        $result    = [];
        //可做优化,删除values下面的数组中prop_id,prop_name,减少数据量;
        foreach ($relations as $relation) {
            if (!key_exists($relation['prop_id'], $result)) {
                $result[$relation['prop_id']] = [
                    "values" => [$relation],
                    "prop_name" => $relation['prop_name'],
                ];
            } else {
                $result[$relation['prop_id']]['values'][] = $relation;
            }
        }
        $cacheFilePath = base_path('database/helpers/categoryProperties.php');
        return file_put_contents($cacheFilePath, serialize($result)) ? true : false;
    }


}