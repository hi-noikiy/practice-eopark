<?php
namespace App\Repositories;

use App\Repositories\Models\LettersModel;

class LettersRep {
    public static function getNotViewByTo($toUserId) {
        //bug 该方式只能显示10个最新发消息的联系人消息,
        //超出后历史未读消息需要等到总发消息人不足10人才能显示
        $fromUserIds = LettersModel::select([
            'from_user_id',
            'users.name',
        ])->leftJoin('users', 'users.id', '=', 'letters.from_user_id')->where([
            "is_viewed" => 0,
            "to_user_id" => $toUserId,
        ])->groupBy("from_user_id")->orderBy("letters.created_at", "desc")->limit(10)->get();

        $result = [];
        $select = [
            "content",
            "created_at",
            'id',
        ];
        $where  = [
            'to_user_id' => $toUserId,
            'is_viewed' => 0,
        ];
        foreach ($fromUserIds as $fromUserId) {
            $where['from_user_id'] = $fromUserId->from_user_id;
            $result[]              = [
                'content' => LettersModel::select($select)->where($where)->orderBy('created_at', "desc")->limit(5)
                                         ->get()->toArray(),
                'from_user_id' => $fromUserId->from_user_id,
                'from_user_name' => $fromUserId->name,
                'number' => LettersModel::where($where)->count(),
            ];
        }
        return $result;
    }

    public static function getDataByFromIdToId($fromUserId, $toUserId, $id) {
        $where = [
            'from_user_id' => $fromUserId,
            'to_user_id' => $toUserId,
            //            'is_viewed' => 0
        ];
        $orWhere = [
            'to_user_id' => $fromUserId,
            'from_user_id' => $toUserId,
        ];
//        if($id !== false){
//            $where["id"]
//        }
//        ->where(function($query){
//            $query->where('status','<','61')
//                  ->orWhere(function($query){
//                      $query->where('status', '91');
//                  });
//        })
        //bug 超过10条新消息不能及时显示
        $select = " eo_letters.*,eo_a.name as from_name,eo_b.name as to_name";
        $query  = LettersModel::selectRaw($select)->leftJoin("users as a", 'a.id', '=', 'letters.from_user_id')
                              ->leftJoin("users as b", 'b.id', '=', 'letters.to_user_id')->limit(10)
                              ->orderBy('created_at', 'desc');

        $data = $query->where(function ($myQuery) use ($id, $where) {
            $myQuery->where('letters.id', '>=', $id)->where($where);
        })->orWhere(function ($myQuery) use ($id, $orWhere) {
            $myQuery->where('letters.id', '>=', $id)->where($orWhere);
        })->get()->toArray();

        LettersModel::setViewed($where);
        krsort($data);
        return $data;
    }

    public static function getAll($toUserId) {
        return LettersModel::select([
            "letters.is_viewed",
            "letters.from_user_id",
            "letters.content",
            "letters.created_at",
            "letters.id",
            "users.name"
        ])->leftJoin('users', 'users.id', '=', 'letters.from_user_id')->where("to_user_id", $toUserId)
                           ->orderBy('created_at', 'desc')->paginate(20);
    }

    public static function getUnreadNum($userId) {
        return LettersModel::where([
            'to_user_id' => $userId,
            'is_viewed' => 0
        ])->count();
    }


}