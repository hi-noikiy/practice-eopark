<?php
namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class ThanksModel extends Model {

    protected $table = 'thanks';
    protected $fillable = [
        'user_id',
        'gratitude',
//        'special',
//        'wish'
    ];

}
