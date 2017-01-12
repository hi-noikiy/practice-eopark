<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Models\BrandCateRelationModel;
use App\Repositories\Models\BrandModel;
use App\Repositories\Models\CategoriesModel;
use App\Repositories\Models\ResourcesModel;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;

class BrandController extends Controller {

    public function index() {
//        $brands = BrandModel::leftJoin("brand_cate_relation", "brand_cate_relation.brand_id", "=", "brands.id")
////                            ->leftJoin("categories", 'categories.id', '=', 'brand_cate_relation.category_id')
//                            ->orderBy("id", "desc")->groupBy("brands.id")->paginate(15);
        $brands = BrandModel::orderBy("id", "desc")->groupBy("id")->paginate(15);
//        dd($brands);
        return view("admin.brand", ["brands" => $brands]);
    }

    public function addSave(Request $request) {
        $data = $request->input();
        if ($data['brand_logo_url']) {
            $data['brand_logo'] = $data['brand_logo_url'];
        } else {
            $data['brand_logo'] = upLoadImg(Input::file('brand_logo'), "brand");
        }
        $data['official_url'] = httpAdapter($data['official_url']);
        if (!$data['priority']) {
            $data['priority'] = BrandModel::max("priority") + 1;
        }
        setReturnMessage(BrandModel::create($data));
        return redirect("/admin/brand/add");
    }

    public function edit($id) {
        $brand = BrandModel::where("id", $id)->first();
//        $categoryId = BrandCateRelationModel::where("brand_id", $brand->id)->pluck("category_id")->first();
        return view("admin.brand_edit", ['brand' => $brand]);
    }

    public function editSave() {
        $data               = Input::all();
        $data['brand_logo'] = $data['brand_logo_url'] ? $data['brand_logo_url'] : upLoadImg(Input::file('brand_logo'), "brand");

        setReturnMessage(BrandModel::where("id", $data["id"])->update([
            "brand_name" => $data["brand_name"],
            "brand_logo" => $data["brand_logo"],
            "status" => $data["status"],
            "official_url" => httpAdapter($data['official_url']),
            "priority" => $data["priority"],
        ]));
        return redirect("/admin/brand");
    }

    public function showCategories($brandId) {
        $brandCategories = BrandCateRelationModel::leftJoin('categories', 'categories.id', '=', 'brand_cate_relation.category_id')->select('categories.name as category_name', 'brand_cate_relation.id')->where("brand_cate_relation.brand_id", $brandId)->get();
        return view('admin.brand_show_categories', [
            'brandCategories' => $brandCategories,
            "id" => $brandId
        ]);
    }

    public function addCateRelationSave($brandId) {
        $categories = Input::get();
        if (isset($categories["category_3"]) && $categories["category_3"]) {
            $categoryId = $categories["category_3"];
        } else {
            if (isset($categories["category_2"]) && $categories["category_2"]) {
                $categoryId = $categories["category_2"];
            } else {
                $categoryId = $categories["category_1"];
            }
        }
        $result = BrandCateRelationModel::create([
            'brand_id' => $brandId,
            'category_id' => $categoryId
        ]);
        setReturnMessage($result);
        return redirect('/admin/brand/showCategories/'.$brandId);
    }


    public function editCategorySave($id) {
        $categories = Input::get();
        if (isset($categories["category_3"]) && $categories["category_3"]) {
            $categoryId = $categories["category_3"];
        } else {
            if (isset($categories["category_2"]) && $categories["category_2"]) {
                $categoryId = $categories["category_2"];
            } else {
                $categoryId = $categories["category_1"];
            }
        }
        $result = BrandCateRelationModel::where("id", $id)->update([
            "category_id" => $categoryId
        ]);
        setReturnMessage($result);
        $brandId = BrandCateRelationModel::where("id", $id)->pluck('brand_id')->first();
        return redirect("/admin/brand/showCategories/" . $brandId);
    }

    public function delete($id) {
        setReturnMessage(BrandModel::deleteById($id));
        return redirect("/admin/brand");
    }

    public function deleteCateRelation($relationId) {
        setReturnMessage(BrandCateRelationModel::where("id", $relationId)->delete());
        return redirect()->back();
    }
}