<?php
namespace App\Http\Controllers;


use App\Repositories\BrandsRep;
use App\Repositories\Models\BrandCateRelationModel;
use App\Repositories\Models\BrandModel;
use App\Repositories\Models\CategoriesModel;
use App\Repositories\Models\PropCateRelationModel;
use App\Repositories\Models\PropResRelationModel;
use App\Repositories\Models\PropValueModel;
use App\Repositories\Models\ResourcesModel;
use Illuminate\Support\Facades\Input;

class ResourcesController extends Controller {
    private $condition, $filterResult;

    public function __construct() {
        $this->filterResult = $this->paramAdapter();
    }

    /**
     * @return array
     * 适配url ?之后跟的参数,返回相应的筛选条件
     */
    private function paramAdapter() {
        $filterResult = [];
        $brandId      = Input::get('brand');
        if ($brandId) {
            $this->condition["brand_id"] = $brandId;
            $filterResult['brands']      = BrandModel::where('id', $brandId)->get();
        }
        $type = Input::get('type');
        if ($type === '0' || $type) {
            $filterResult['type'] = $this->condition["type"] = $type;
        }
        $order = Input::get('order');
        if ($order) {
            $filterResult['order'] = $this->condition["order"] = $order;
        }
        return $filterResult;
    }

    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 未选择筛选条件下时进入,返回该类目下热门资源
     */
    public function index($categoryId) {
        $this->condition["categoryId"] = $categoryId;
        $filterResult                  = $this->filterResult;

        $filterResult['resources'] = ResourcesModel::getDataByCateId($this->condition);

        $propValueIds               = PropCateRelationModel::getPropValueIdsByCateId($categoryId);
        $filterResult['properties'] = PropValueModel::getPropGroupsByIds($propValueIds);
        $filterResult["categories"] = CategoriesModel::getChainById($categoryId);

        //获取当前分类及子分类包含的品牌
        if (!isset($filterResult["brands"])) {
            $cateChain              = CategoriesModel::getSelfAndChildren($categoryId);
            $brandIds               = BrandCateRelationModel::getBrandIdsByCateIdChain($cateChain);
            $filterResult["brands"] = count($brandIds) ? BrandModel::getDataByIds($brandIds) : null;
        }
        return view('resources', $filterResult);
    }

    /**
     * @param $categoryId
     * @param $filterStr
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View 格式:propValueId1-propValueId2-propValueId3...
     *
     * 格式:propValueId1-propValueId2-propValueId3...
     * 1 取得到prop_value_id数组
     * 2 查表prop_res_relation 获取到不重复resource_id数组
     * 3 根据resource_id数组查表prop_res_relation ,获取到筛选后的数据还具有的筛选条件leftValueIds数组
     * 4 根据leftValueIds 数组,查表prop_value获取到相应所属属性链
     */
    public function filter($categoryId, $filterStr) {
        $filterResult = $this->filterResult;
        $filters      = explode("-", $filterStr);
        $query        = PropResRelationModel::groupBy("resource_id");
        foreach ($filters as $filter) {
            $query->orWhere("prop_value_id", $filter);
        }
        //查找当前筛选条件下,是否有资源
        $resourceIds = $query->lists("resource_id");

        if (count($resourceIds)) {
            $this->condition["ids"]    = $resourceIds;
            $result                    = ResourcesModel::getDataByFilter($this->condition);
            $filterResult['resources'] = $result["resources"];
            //用户未选择品牌,查找剩余资源包含的品牌
            if (!isset($filterResult['brands']) && count($result["brand_ids"])) {
                $filterResult['brands'] = BrandsRep::getByBrandIds($result["brand_ids"]);
            }
        } else {
            $filterResult['resources'] = [];
        }

        $propValueIds                = PropCateRelationModel::getPropValueIdsByCateId($categoryId);
        $filterResult['properties']  = PropValueModel::getPropGroupsByIds($propValueIds);
        $filterResult["categories"]  = CategoriesModel::getChainById($categoryId);
        $filterResult['selectedIds'] = json_encode($filters);

        return view("resources", $filterResult);
    }

}