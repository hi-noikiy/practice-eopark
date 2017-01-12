<?php
namespace App\Http\Controllers;

use App\Repositories\Models\CollectsModel;
use Illuminate\Http\Request;

class IndexController extends Controller {

    public function __construct() {
        setFacadeNavigation('index_active');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 依据是否登录给出相应数据
     */
    public function index() {
        $userId = $this->getUserId();
        $data   = $userId ? CollectsModel::getByUserId($userId) : config('set.defaultIndexNev');
        return view("index", [
            "data" => json_encode($data)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 新增数据
     */
    public function add(Request $request) {
        $addedArr = CollectsModel::add([
            'url_name' => $request->input('url_name'),
            'url' => httpAdapter($request->input('url')),
        ], $this->getUserId());
        return response()->json($addedArr);
    }


    /**
     * @param $collectId
     * @param $x
     * @param $y
     * 新增导航时,位置是自动排序到导航尾部的,数据库没有x,y数据,需要更新位置数据;
     */
    public function updatePosition($collectId, $x, $y) {
        $userId = $this->getUserId();
        CollectsModel::where([
            "id" => $collectId,
            'user_id' => $userId
        ])->update([
            "x" => $x,
            "y" => $y
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 修改导航名字,连接
     */
    public function edit(Request $request) {
        $userId = $this->getUserId();
        $url    = httpAdapter($request->input("url"));
        $result = CollectsModel::where([
            "id" => $request->input('id'),
            'user_id' => $userId
        ])->update([
            "url" => $url,
            "url_name" => $request->input("url_name"),
        ]);
        return response()->json($result ? $url : false);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 保存操作移动位置,大小数据
     */
    public function move(Request $request) {
        $userId = $this->getUserId();
        $data   = $request->input();
        unset($data["_token"]);
        foreach ($data as $value) {
            CollectsModel::where([
                'user_id' => $userId,
                "id" => $value["id"]
            ])->update(array(
                "x" => $value["x"],
                "y" => $value["y"],
                "width" => $value["width"],
                "height" => $value["height"],
            ));
        }
        return response()->json($request->input());
    }


    /**
     * @param $collectIds
     * 点击保存时,批量删除需要删除的数据
     */
    public function delete($collectIds) {
        $this->getUserId();
        $ids = explode("_", $collectIds);
        foreach ($ids as $id) {
            if (is_numeric($id)) {
                CollectsModel::deleteById($id);
            }
        }
    }

//获取网站favicon.ico工具网站
//http://statics.dnspod.cn/proxy_favicon/_/favicon?domain=www.baidu.com
//http://www.google.com/s2/favicons?domain=
//http://g.soz.im/
//http://favicon.byi.pw/?url=
}
