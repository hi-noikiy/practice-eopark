<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Models\PropCateRelationModel;
use App\Repositories\Models\PropertiesModel;
use App\Repositories\Models\PropValueModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PropertyController extends Controller {

    public function all() {
        $properties = PropertiesModel::orderBY("id", "asc")->paginate(10);
        foreach ($properties as $key => $property) {
            $properties[$key]["value"] = PropValueModel::where("prop_id", $property->id)->get();
        }
        return view("admin.property", ['properties' => $properties]);
    }


    public function addValueSave(Request $request) {
        $data   = $request->input();
        $result = PropValueModel::create([
            "prop_id" => $data["prop_id"],
            "name" => $data["name"],
            'priority' => $data['priority'],
            'status' => $data['status'],
        ]);
        setReturnMessage($result);
        return redirect("admin/property/addValue/{$data['prop_id']}");
    }

    public function edit($id) {
        $property   = PropertiesModel::where("id", $id)->first();
        $properties = PropertiesModel::where("status", 1)->get();
        return view("admin.property_edit", [
            "property" => $property,
            "properties" => $properties
        ]);
    }

    public function editSave(Request $request) {
        $input  = $request->input();
        $result = PropertiesModel::where("id", $input["id"])->update([
            "name" => $input["name"],
            "status" => $input["status"],
            "priority" => $input["priority"],
        ]);
        setReturnMessage($result);
        return redirect("/admin/property/edit/{$input["id"]}");
    }

    public function editValue($id) {
        $value = PropValueModel::where([
            "id" => $id,
            "status" => 1
        ])->first();
        return view("admin.property_value_edit", ["value" => $value]);
    }

    public function editValueSave(Request $request) {
        $input  = $request->input();
        $result = PropValueModel::where("id", $input["id"])->update([
            'prop_id' => $input["prop_id"],
            'status' => $input["status"],
            'priority' => $input["priority"],
            'name' => $input["name"],
        ]);
        setReturnMessage($result);
        return redirect("/admin/property");
    }


    public function assignCategory($id, PropertiesModel $propertiesModel) {
        $ownProp = PropCateRelationModel::where([
            "category_id" => $id,
            "status" => 1
        ])->get()->pluck("prop_value_id")->toArray();

        return view('admin.property_category', [
            "properties" => $propertiesModel->getAll(),
            "ownProperty" => $ownProp,
        ]);
    }

    public function assignCategorySave($categoryId, Request $request) {
        PropCateRelationModel::where("category_id", $categoryId)->delete();
        $data = [];
        foreach ($request->input("value") as $propValue) {
            $data[] = [
                "category_id" => $categoryId,
                "prop_value_id" => $propValue,
            ];
        }
        setReturnMessage(PropCateRelationModel::insert($data));
        return redirect("/admin/property/assignCategory/{$categoryId}");
    }


    public function deleteProp($propId, PropertiesModel $propertiesModel) {
        $propertiesModel->deleteById($propId);
        setReturnMessage(true);
        return redirect("admin/property");
    }

    public function deletePropValue($id, PropValueModel $propValueModel) {
        $propValueModel->deleteById($id);
        setReturnMessage(true);
        return redirect("admin/property");
    }

    public function addPropSave() {
        setReturnMessage(PropertiesModel::create(Input::get()));
        return redirect("admin/property/addProp");

    }

}