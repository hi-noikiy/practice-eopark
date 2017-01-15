<?php
namespace App\Repositories;

use App\Repositories\Models\LettersModel;

class LettersRep {
    public static function getNotViewByTo($toUserId) {
        //bug 该方式只能显示10个最新发消息的联系人消息,超出后历史未读消息需要等到总发消息人不足10人才能显示
        $fromUserIds = LettersModel::select([
            'from_user_id', 'users.name',
        ])->leftJoin('users', 'users.id', '=', 'letters.from_user_id')->where([
            "is_viewed" => 0, "to_user_id" => $toUserId,
        ])->groupBy("from_user_id")->orderBy("letters.created_at", "desc")->limit(10)->get();

        $result = [];
        $select = [
            "content", "created_at", 'id',
        ];
        $where  = [
            'to_user_id' => $toUserId, 'is_viewed' => 0,
        ];
        foreach ($fromUserIds as $fromUserId) {
            $where['from_user_id'] = $fromUserId->from_user_id;
            $result[]              = [
                'content' => LettersModel::select($select)->where($where)->orderBy('created_at', "desc")->limit(5)
                                         ->get()->toArray(), 'from_user_id' => $fromUserId->from_user_id,
                'from_user_name' => $fromUserId->name, 'number' => LettersModel::where($where)->count(),
            ];
        }

        return $result;
    }

    public static function getDataByFromIdToId($fromUserId, $toUserId) {
        $where = ['from_user_id' => $fromUserId, 'to_user_id' => $toUserId, 'is_viewed' => 0];
        //bug 超过10条新消息不能及时显示
        $data = LettersModel::where($where)->limit(10)->orderBy('created_at', 'desc')->get();
        LettersModel::setViewed($where);

        return $data;
    }


}