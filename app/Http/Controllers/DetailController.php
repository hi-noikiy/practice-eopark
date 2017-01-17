<?php
namespace App\Http\Controllers;

use App\Repositories\Models\CategoriesModel;
use App\Repositories\Models\CollectsModel;
use App\Repositories\Models\ResGradesModel;
use App\Repositories\Models\ResourcesModel;
use App\Repositories\Models\UsersModel;
use Illuminate\Http\Request;
use App\Repositories\Models\CommentsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller {

    public function index($resourceId) {
        $detail = ResourcesModel::leftJoin('users', function ($join) {
            $join->on('resources.contributor', '=', 'users.id');
        })->leftJoin("brands", "brands.id", "=", "resources.brand_id")->where([
            "resources.id" => $resourceId,
            "resources.status" => 1
        ])->select('resources.*', 'users.name as user_name', "brands.brand_name")->get()->first();
        if (!count($detail)) {
            return abort(404);
        }

        $cateSelect              = [
            "id",
            "name",
            'status'
        ];
        $detail->category_1_name = CategoriesModel::select($cateSelect)->where("id", $detail->category_1)->first();
        $detail->category_2_name = CategoriesModel::select($cateSelect)->where("id", $detail->category_2)->first();
        $detail->category_3_name = CategoriesModel::select($cateSelect)->where("id", $detail->category_3)->first();
//        //判断资源分类是否为关闭状态,若某资源没有category_3时会进判断
//        if (!count($detail->category_1_name) || !count($detail->category_2_name) || !count($detail->category_3_name)) {
//            return abort(404);
//        }

        ResourcesModel::where("id", $resourceId)->increment("views");

        $comments = DB::table('comments')->select('comments.*', 'a.name as user_name', 'b.name as reply_name')
                      ->leftJoin('users AS a', 'a.id', '=', 'comments.user_id')
                      ->leftJoin('users AS b', 'b.id', '=', 'comments.reply')
                      ->where("comments.resource_id", $resourceId)->orderBy("likes", 'desc')->paginate(10);
        $userId   = $this->getUserId();
        foreach ($comments->toArray()['data'] as $key => $value) {
            if (strpos($value->likes_user_id, ",{$userId},") === false) {
                $value->likes_user_id = false;
            } else {
                $value->likes_user_id = true;
            }
        }
        $myScore = ResGradesModel::where(array(
            "user_id" => $userId,
            "resource_id" => $resourceId
        ))->pluck("grade")->first();

        $collect = CollectsModel::where([
            "user_id" => $userId,
            'resource_id' => $resourceId
        ])->first();
        return view("detail", [
            'detail' => $detail,
            'comments' => $comments,
            "myScore" => $myScore,
            "collect" => $collect
        ]);
    }

    public function addComment($resourceId, Request $request) {
        if (!Auth::Check()) {
            return response()->json('NOT_LOGIN');
        }
        $userId      = Auth::id();
        $comment     = htmlspecialchars($request->input("comment"));
        $isReply     = substr($comment, 0, 1);
        $replyUserId = 0;
        if ($isReply == "@") {
            $commentStartPos = stripos($comment, ":");
            $userName        = substr($comment, 1, $commentStartPos - 1);
            $replyUserId     = UsersModel::where("name", $userName)->pluck("id")->first();
            if ($replyUserId) {

                $comment          = substr($comment, $commentStartPos + 1, strlen($comment));
                //通知被回复id;
                $LetterController = new MyLetterController();
                $LetterController->send($replyUserId, $comment);
            }
        }
        $commentResult = response()->json(CommentsModel::create([
            "user_id" => $userId,
            "reply" => $replyUserId,
            "comment" => $comment,
            "resource_id" => $resourceId,
        ]));
        ResourcesModel::where("id", $resourceId)->increment("comment_numbers");
        return $commentResult;
    }

    public function changeLikesStatus($id, $commentId) {
        if (!Auth::Check()) {
            return response()->json('NOT_LOGIN');
        }
        $userId       = Auth::id();
        $likesUserIds = CommentsModel::where("id", $commentId)->pluck('likes_user_id')->first();
        if (strpos($likesUserIds, ",{$userId},") === false) {
            if ($likesUserIds) {
                $likesUserIds .= "{$userId},";
            } else {
                $likesUserIds = ",{$userId},";
            }
            $return = true;
            CommentsModel::where("id", $commentId)->increment("likes");
        } else {
            $likesUserIds = preg_replace('/,' . $userId . ',/', ",", $likesUserIds);
            $return       = false;
            CommentsModel::where("id", $commentId)->decrement("likes");
        }
        CommentsModel::where("id", $commentId)->update(array("likes_user_id" => $likesUserIds));
        return $return;
    }

    public function changeGrade($resourceId, $grade) {
        if (!Auth::Check()) {
            return response()->json('NOT_LOGIN');
        }
        $userId = Auth::id();

        $gradeId = ResGradesModel::where(array(
            "resource_id" => $resourceId,
            "user_id" => $userId,
        ))->pluck("id")->first();
        if ($gradeId) {
            ResGradesModel::where("id", $gradeId)->update(array("grade" => $grade));
        } else {
            ResGradesModel::create(array(
                "user_id" => $userId,
                "resource_id" => $resourceId,
                "grade" => $grade
            ));
        }
        ResourcesModel::where("id", $resourceId)
                      ->update(['scored_numbers' => ResGradesModel::where("resource_id", $resourceId)->count()]);

        return response()->json($grade);
    }

}