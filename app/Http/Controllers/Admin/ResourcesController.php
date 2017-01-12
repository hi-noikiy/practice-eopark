<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BrandCateRelationRep;
use App\Repositories\Models\PropertiesModel;
use App\Repositories\Models\PropResRelationModel;
use App\Repositories\Models\ResourcesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Common\Traits\UpdateCacheTrait;


class ResourcesController extends Controller {
    use UpdateCacheTrait;

    public function __construct() {
        setAdminNavigation("resource_active");
    }

    public function index() {
        $resources = DB::table('resources')
                       ->select('resources.*','e.brand_name','d.name as contributor', 'a.name as category_1_name', 'b.name as category_2_name', 'c.name as category_3_name')
                       ->leftJoin('categories AS a', 'a.id', '=', 'resources.category_1')
                       ->leftJoin('categories AS b', 'b.id', '=', 'resources.category_2')
                       ->leftJoin('categories AS c', 'c.id', '=', 'resources.category_3')
                       ->leftJoin('users AS d', 'd.id', '=', 'resources.contributor')
                       ->leftJoin('brands AS e', 'e.id', '=', 'resources.brand_id')->orderBy("id", 'desc')
                       ->paginate(10);
        return view("admin.resources", ["resources" => $resources]);
    }

    public function edit($id) {

        $resource = DB::table('resources')
                      ->select('resources.*', 'a.name as category_1_name', 'b.name as category_2_name', 'c.name as category_3_name')
                      ->leftJoin('categories AS a', 'a.id', '=', 'resources.category_1')
                      ->leftJoin('categories AS b', 'b.id', '=', 'resources.category_2')
                      ->leftJoin('categories AS c', 'c.id', '=', 'resources.category_3')->where("resources.id", $id)
                      ->first();
        return view("admin.resources_edit", [
            "resource" => $resource,
            'categories' => getCategoryAllCache(),
            "properties" => PropertiesModel::getAll(),
            "ownProperty" => PropResRelationModel::getDataByResId($resource->id),
            "brandRelations" => BrandCateRelationRep::getRelations()
        ]);
    }

    public function editSave($id) {
        $data = Input::all();
        if ($data['cover_url']) {
            $data['cover'] = $data['cover_url'];
        } else {
            $data['cover'] = upLoadImg(Input::file('cover'), "resource");
        }
        unset($data["cover_url"]);

        $relationResult = true;
        if (isset($data["value"]) && count($data["value"])) {
            $propValues     = $data["value"];
            $relationResult = PropResRelationModel::addData($propValues, $id);
            unset($data["value"]);
        }
        $data['link'] = httpAdapter($data['link']);
        $resResult    = ResourcesModel::where("id", $id)->update($data);
        setReturnMessage($relationResult && $resResult ? true : false);
        return redirect("admin/resource");
    }


    public function add() {
        return view('admin.resources_add', [
            "categories" => getCategoryAllCache(),
            "properties" => PropertiesModel::getAll(),
            "brandRelations" => BrandCateRelationRep::getRelations()
        ]);
    }

    public function addSave(Request $request) {
        $data          = $request->input();
        $data['cover'] = $data['cover_url'] ? $data['cover_url'] : upLoadImg(Input::file('cover'), "resource");
        $data['link']  = httpAdapter($data['link']);

        $result = ResourcesModel::create($data);

        $relationResult = true;
        if (isset($data["value"]) && count($data["value"])) {
            $propValues     = $data["value"];
            $relationResult = PropResRelationModel::addData($propValues, $result->id);
        }

        setReturnMessage($relationResult && $result->id);
        return redirect('admin/resource/add');
    }

    public function delete($id) {
        setReturnMessage(ResourcesModel::where("id", $id)->delete());
        return back();
    }

    public function changeStatus($id) {
        $status = ResourcesModel::where("id", $id)->pluck("status")->first();
        ResourcesModel::where("id", $id)->update(array('status' => $status ? false : true));
        return response()->json(!$status);
    }

    public function updateCache() {
        setReturnMessage($this->updateResources());
        return redirect("/admin/resource");
    }
}