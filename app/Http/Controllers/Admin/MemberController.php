<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\Models\UsersModel;
use App\Repositories\UsersRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Crypt;

class MemberController extends Controller {
    public function __construct() {
        setAdminNavigation("member_active");
    }

    public function index(UsersRepository $MemberRep, Request $request) {
        $name    = $request->input('name');
        $members = $MemberRep->getAll($name);
        return view('admin.member_index', [
            "members" => $members
        ]);
    }

    public function edit($id, UsersRepository $MemberRep) {
        $members = $MemberRep->getone($id);
        return view('admin.member_detail', ["members" => $members]);
    }

    public function editSave($id, UsersRepository $MemberRep, Request $request) {
        $data = $request->input();
        $MemberRep->edit($id, $data);
        return redirect('/admin/member');
    }

    public function delete(UsersRepository $MemberRep, $id) {
        $MemberRep->deleteById($id);
        return redirect('/admin/member');
    }

    public function add(Request $request) {
        $inputData = $request->input();
        $time      = date('Y-m-d H:i:s');
        $result    = UsersModel::create(array(
            'name' => $inputData['name'],
            'email' => $inputData['email'],
            'password' => bcrypt($inputData['password']),
            'create_at' => $time,
            'update_at' => $time
        ));
        setReturnMessage($result->id);
        return back();
    }
}