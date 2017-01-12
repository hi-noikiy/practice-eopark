<?php
namespace App\Http\Controllers;

use App\Repositories\Models\UserNavigationModel;
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
        $userId = self::getUserId();
        $data   = $userId ? UserNavigationModel::getByUserId($userId) : config('set.defaultIndexNev');
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
        $userId = self::getUserId();
        if (!$userId) {
            return response("NOT_LOGIN");
        }
        $addedArr = UserNavigationModel::add([
            'url_name' => $request->input('url_name'),
            'url' => httpAdapter($request->input('url')),
        ], $userId);
        return response()->json($addedArr);
    }


    /**
     * @param $collectId
     * @param $x
     * @param $y
     * 新增导航时,位置是自动排序到导航尾部的,数据库没有x,y数据,需要更新位置数据;
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updatePosition($collectId, $x, $y) {
        $userId = self::getUserId();
        if (!$userId) {
            return response("NOT_LOGIN");
        }
        UserNavigationModel::where([
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
        $userId = self::getUserId();
        if (!$userId) {
            return response("NOT_LOGIN");
        }
        $url    = httpAdapter($request->input("url"));
        $result = UserNavigationModel::where([
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
        $userId = self::getUserId();
        if (!$userId) {
            return response("NOT_LOGIN");
        }
        $data = $request->input();
        unset($data["_token"]);
        foreach ($data as $value) {
            UserNavigationModel::where([
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
        if (!self::getUserId()) {
            return response("NOT_LOGIN");
        }
        $ids = explode("_", $collectIds);
        foreach ($ids as $id) {
            if (is_numeric($id)) {
                UserNavigationModel::deleteById($id);
            }
        }
    }

//获取网站favicon.ico工具网站
//http://statics.dnspod.cn/proxy_favicon/_/favicon?domain=www.baidu.com
//http://www.google.com/s2/favicons?domain=
//http://g.soz.im/
//http://favicon.byi.pw/?url=
}
