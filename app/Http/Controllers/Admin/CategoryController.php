<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Models\CategoriesModel;
use Illuminate\Http\Request;
use App\Repositories\CategoriesRepository;

class CategoryController extends Controller {

    public function __construct() {
        setAdminNavigation("resource_active");
    }

    public function index() {
        return view("admin.category", array(
            "categories" => getCategoryAllCache(),
        ));
    }

    public function edit($id) {
        $data       = CategoriesModel::where("id", $id)->first();
        $parentData = null;
        if ($data->parent_id) {
            $parentData = CategoriesModel::getChainById($data->parent_id);
        }
        return view("admin.category_edit", [
            "thisCategory" => $parentData,
            "data" => $data
        ]);
    }

    public function editSave(Request $request) {
        $inputData = $request->input();
        $parentId  = 0;
        $depth     = 1;
        if ($inputData['category_1']) {
            $parentId = $inputData['category_1'];
            $depth    = 2;
            if ($inputData['category_2']) {
                $parentId = $inputData['category_2'];
                $depth    = 3;
            }
        }
        $result = CategoriesModel::where("id", $inputData["id"])->update(array(
            'name' => $inputData['name'],
            'parent_id' => $parentId,
            'depth' => $depth,
            'priority' => $inputData['priority'],
            'status' => $inputData['status'],
        ));
        //更改子类状态
        CategoriesModel::where("parent_id", $inputData["id"])->update([
            'status' => $inputData['status'],
        ]);
        $depth2 = CategoriesModel::where("parent_id", $inputData["id"])->lists('id');
        foreach ($depth2 as $depth2Id) {
            CategoriesModel::where("parent_id", $depth2Id)->update([
                'status' => $inputData['status']
            ]);
        }
        setReturnMessage($result);
        return redirect('/admin/category');
    }


    public function delete($id,  $categoriesRep) {
        $result = $categoriesRep->delete($id);
        setReturnMessage($result);
        return redirect('/admin/category');
    }

    public function add($parentId) {
        return view("admin.category_add", ["thisCategory" => CategoriesModel::getChainById($parentId)]);
    }

    public function addSave(Request $request) {
        $inputData = $request->input();
        $parentId  = 0;
        $depth     = 1;
        if ($inputData['category_1']) {
            $parentId = $inputData['category_1'];
            $depth    = 2;
            if ($inputData['category_2']) {
                $parentId = $inputData['category_2'];
                $depth    = 3;
            }
        }
        $result = CategoriesModel::create(array(
            'name' => $inputData['name'],
            'parent_id' => $parentId,
            'depth' => $depth,
            'priority' => $inputData['priority'],
        ));
        setReturnMessage($result->id);
        return redirect('/admin/category');
    }
}