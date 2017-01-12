<?php
namespace App\Http\Controllers;

use App\Repositories\ResourcesRep;

class CategoryController extends Controller {
    public function __construct() {
        setFacadeNavigation('category_active');
    }

    public function index() {
        return view("category", [
            "resources_hot" => ResourcesRep::getHot(),
            "categories" => getCategoryCache(),
        ]);
    }

    public function getResources() {
        $path = config("path.resources");
        $data = unserialize(file_get_contents($path));
        return response()->json($data);
    }
}