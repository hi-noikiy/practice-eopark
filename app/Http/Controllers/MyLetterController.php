<?php
namespace App\Http\Controllers;


use App\Repositories\LettersRep;
use App\Repositories\Models\LettersModel;
use App\Repositories\Models\UsersModel;

class MyLetterController extends Controller {

    private static $userId;

    public function __construct() {
        self::$userId = self::getUserId(TRUE);
    }

    /**
     * 信箱首页,显示未读消息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view("my_letter", ["letters" => LettersRep::getNotViewByTo(self::$userId)]);
    }

    public function viewByFrom($fromUserId) {
        return view('my_letter_view', [
            'letters' => LettersRep::getDataByFromIdToId($fromUserId, self::$userId),
            'from'    => UsersModel::getDataById($fromUserId,['name']),
        ]);
    }

}