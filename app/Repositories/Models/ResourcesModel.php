<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class ResourcesModel extends Model {
    //表名
    protected $table = 'resources';

    //白名单,支持批量赋值的字段
    protected     $fillable = [
        'title',
        'from_domain',
        'from_domain_name',
        'introduce',
        'cover',
        'author',
        'type',
        'category_1',
        'category_2',
        'category_3',
        'link',
        'status',
        'contributor',
        'is_pay',
        'brand_id',
    ];
    public static $select   = [
        "id",
        "title",
        "cover",
        "score",
        "scored_numbers",
        "comment_numbers",
    ];


    public static function getData(Array $where, Array $order, $limit) {
        return ResourcesModel::where($where)->orderBy($order)->limit($limit)->get();
    }

    /**
     * @param $conditions [
     *  "categoryId"=>1,
     *  "brand"=>1,  //可不传入
     *  "type"=>1,   //可不传入
     *  "order"=>"views"] // 默认为views
     * @return $resources
     * 根据categoryId返回orderBy排序后的数据
     */
    public static function getDataByCateId($conditions) {
        $query = ResourcesModel::select(self::$select);
        $where = ["status" => 1];
        if (isset($conditions["brand_id"])) {
            $where["brand_id"] = $conditions["brand_id"];
        }
        if (isset($conditions["type"])) {
            $where["type"] = $conditions["type"];
        }
        if (!isset($conditions["order"])) {
            $conditions["order"] = "views";
        }
        for ($i = 1; $i < 4; $i++) {
            $where["category_$i"] = $conditions["categoryId"];
            $query->orWhere($where);
            unset($where["category_$i"]);
        }
//        return $query->orderBy($conditions['order'], $conditions['order'] == "created_at" ? "asc" : "desc")->paginate(36);
        return $query->orderBy($conditions['order'],  "desc")->paginate(24);
    }

    /**
     * @param $condition
     * @param string $orderBy
     * @return mixed
     */
    public static function getDataByFilter($condition, $orderBy = "views") {
        $queryRes     = ResourcesModel::select(self::$select)->orderBy($orderBy, $orderBy == "created_at" ? "asc" : "desc");
        $orWhere      = ["status" => 1];
        $brandOrWhere = [];
        $result       = [];
        if (isset($condition["brand"])) {
            $orWhere["brand"] = $condition["brand"];
        } else {
            $queryBrandIds = ResourcesModel::orderBy('brand_id', 'asc');
        }
        if (isset($condition["type"])) {
            $orWhere["type"]      = $condition["type"];
            $brandOrWhere["type"] = $condition["type"];
        }
        if (isset($queryBrandIds)) {
            foreach ($condition["ids"] as $id) {
                $brandOrWhere['resources.id'] = $orWhere['id'] = $id;
                $queryRes->orWhere($orWhere);
                $queryBrandIds->orWhere($brandOrWhere);
            }
            $result["brand_ids"] = $queryBrandIds->lists("brand_id");
        } else {
            foreach ($condition["ids"] as $id) {
                $orWhere['id'] = $id;
                $queryRes->orWhere($orWhere);
            }
            $result["brand_ids"] = [];
        }
        $result["resources"] = $queryRes->paginate(24);
        return $result;
    }


}
