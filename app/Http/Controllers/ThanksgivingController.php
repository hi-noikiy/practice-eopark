<?php
namespace App\Http\Controllers;

use App\Repositories\Models\CategoriesModel;
use App\Repositories\Models\PropResRelationModel;
use App\Repositories\Models\ResourcesModel;
use App\Repositories\Models\ThanksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThanksgivingController extends Controller {
    public function __construct() {
        setFacadeNavigation('thanksgiving_active');
    }

    public function index() {
        $categoryOne = CategoriesModel::getChildren(0);
        $thanks      = ThanksModel::orderBy("id", "desc")->limit(5)->get();
        return view("thanksgiving", [
            "categories" => getCategoryCache(),
            "categoryOne" => $categoryOne,
            "thanks" => $thanks,
        ]);
    }

    public function uploadImg() {
        $fileName   = date("YmdHms") . "_" . rand(10, 99) . ".jpg";
        $fileFolder = $_SERVER["DOCUMENT_ROOT"] . "/img/resource/";
        $tmpName    = $_FILES["file"]["tmp_name"];
        move_uploaded_file($tmpName, $fileFolder . $fileName);
        return response("/img/resource/" . $fileName);
    }


    public function addResource(Request $request) {
        $userId = valueOr(Auth::id());
        $data   = $request->input();
        $cover  = null;
        if ($data['cover']) {
            $cover = $data['cover'];
        } else {
            if ($data['cover_url']) {
                $cover = $data['cover_url'];
            }
        }

        $result = ResourcesModel::create(array(
            'title' => $data['title'],
            'introduce' => $data['introduce'],
            'cover' => $cover,
            'type' => $data['type'],
            'category_1' => valueOr($data['category_1']),
            'category_2' => isset($data['category_2']) ? $data['category_2'] : 0,
            'category_3' => isset($data['category_3']) ? $data['category_3'] : 0,
            'link' => httpAdapter($data['link']),
            'contributor' => $userId,
            'is_pay' => $data['title'],
        ));
        //添加选择的属性
        $properties = explode('-', $data['property']);
        $propInsert = [];
        $propData   = [
            "resource_id" => $result->id,
            "status" => 0
        ];
        foreach ($properties as $property) {
            $propData["prop_value_id"] = $property;
            $propInsert[]              = $propData;
        }
        PropResRelationModel::insert($propInsert);
        return response()->json($result);
    }

    public function addThanks(Request $request) {
        $userId = valueOr(Auth::id());
        $result = ThanksModel::create(array(
            "user_id" => $userId,
            "gratitude" => $request->input('gratitude'),
        ));
        return response()->json($result);
    }


}