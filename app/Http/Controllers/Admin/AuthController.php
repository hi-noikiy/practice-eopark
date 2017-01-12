<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller {
    public function index() {
        return view('admin.index');
    }

//    public function header() {
//        return view('admin.header');
//    }
//
//    public function menu() {
//        return view('admin.menu');
//    }
//
//    public function main() {
//        return view('admin.main');
//    }

    public function getLogin() {
        return view('admin.login');
    }

    public function category() {
        return view("admin.category");
    }


    public function postLogin(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        if ($username == config('set.adminUserName') && $password == config('set.adminPassword')) {
            session(['isAdminLogin' => true]);
            return redirect('admin/');
        } else {
            echo '账号,或者密码错误';
            return view('admin.login');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('admin/');
    }


}