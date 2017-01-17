<?php
namespace App\Http\Controllers;


use App\Repositories\LettersRep;
use App\Repositories\Models\LettersModel;
use App\Repositories\Models\UsersModel;
use Illuminate\Support\Facades\Input;

class MyLetterController extends Controller {

    private static $userId;

    public function __construct() {
        self::$userId = self::getUserId(TRUE);
    }

    /**
     * 信箱首页,显示未读消息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unread() {
        return view("my_letter_unread", ["letters" => LettersRep::getNotViewByTo(self::$userId)]);
    }

    public function all() {
        return view('my_letter_all', [
            'letters' => LettersRep::getAll(self::$userId),
            'newNumber' => count(LettersModel::select("id")->where([
                'to_user_id' => self::$userId,
                'is_viewed' => 0
            ])->groupBy("from_user_id")->get()),
        ]);
    }

    public function reading($fromUserId, $letterId = 0) {
        //bug 只查询了新消息,如果有历史消息应该显示
        $letters   = LettersRep::getDataByFromIdToId($fromUserId, self::$userId, $letterId);
        $unreadNum = LettersRep::getUnreadNum(self::$userId);
        if ($unreadNum) {
            session()->flash('unreadLetterNum', $unreadNum);
        } else {
            session()->forget('unreadLetterNum');
        }

        return view('my_letter_reading', [
            'letters' => $this->dateHandler($letters),
            'from_user_id' => $fromUserId,
            'userData' => UsersModel::select('name')->where("id", self::$userId)->first(),
        ]);
    }


    public function send($toUserId, $content = false) {
        return LettersModel::add([
            'from_user_id' => self::$userId,
            'to_user_id' => $toUserId,
            'content' => $content === false ? Input::get("content") : $content,
        ]);
    }


    private function dateHandler($letters) {
        $today      = strtotime(date("Y-m-d"));
        $lastDay    = 0;
        $listClock  = 0;
        $checkPoint = 1800;
        foreach ($letters as $key => $letter) {
            $createdTime = strtotime($letter['created_at']);
            //判断是否为当天
            if ($createdTime > $today) {
                //当天
                if ($createdTime > $listClock) {
                    $letters[$key]["isShowDate"] = true;
                    //每10分钟显示时间
                    $listClock = $createdTime + $checkPoint;
                } else {
                    $letters[$key]["isShowDate"] = false;
                }
            } else {
                $historyDay = strtotime(date("Y-m-d", $createdTime));
                if ($lastDay != $historyDay) {
                    //该天日期为新的历史天;
                    $letters[$key]["isShowDate"] = true;
                    $lastDay                     = $historyDay;
                } else {
                    $letters[$key]["isShowDate"] = false;
                }
            }
        }
        return $letters;
    }

}