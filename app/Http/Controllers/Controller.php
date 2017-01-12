<?php

namespace App\Http\Controllers;

use ClassPreloader\Config;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getUserId($isMust = false) {
        if (Auth::check()) {
            return Auth::id();
        } else {
            if ($isMust) {
                header('Location:' . Config::get('set.setRoot') . '/login');
                exit;
            } else {
                return 0;
            }
        }
    }

}
