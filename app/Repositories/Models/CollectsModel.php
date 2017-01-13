<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class CollectsModel extends Model {

    protected $table = 'collects';

    protected $fillable = [
        'user_id',
        'resource_id',
    ];

    public static function deleteById($id) {
        return CollectsModel::where([
            "id" => $id,
        ])->delete();
    }

    public static function add($data) {
        $result = CollectsModel::where($data)->first();
        if (!$result) {
            return CollectsModel::create($data);
        }
        return $result;
    }
}
