<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\Models\UsersModel;
use App\Repositories\UsersRep;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Crypt;

class UserController extends Controller {
    public function __construct() {
        setAdminNavigation("user_active");
    }

    public function index(Request $request) {
        $name    = $request->input('name');
        $members = UsersRep::getAll($name);
        return view('admin.user_index', [
            "users" => $members
        ]);
    }

    public function edit($id) {
        return view('admin.user_detail', ["user" => UsersModel::getDataById($id)]);
    }

    public function editSave($id, Request $request) {
        UsersModel::edit($id, $request->input());
        return redirect('/admin/user');
    }

    public function delete($id) {
        UsersModel::deleteById($id);
        return redirect('/admin/user');
    }

    public function add(Request $request) {
        $result = UsersModel::create(array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ));
        setReturnMessage($result->id);
        return back();
    }
}