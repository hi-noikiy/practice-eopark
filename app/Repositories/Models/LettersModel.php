<?php
/**
 * Created by PhpStorm.
 * User: Qskane_Thinkpad
 * Date: 2017/1/13
 * Time: 21:26
 */
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class LettersModel extends Model {
    protected $table    = 'letters';
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'content',
    ];

    public static function setViewed($where) {
        if (!is_array($where)) {
            return NULL;
        }
        return LettersModel::where($where)->update(['is_viewed' => 1]);
    }

    public static function add($data) {
        if (!is_array($data)) {
            return NULL;
        }
        return LettersModel::create($data);
    }


}