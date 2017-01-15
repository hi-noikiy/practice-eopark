<?php
namespace App\Repositories\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class UsersModel extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword;
    protected $table    = 'users';
    protected $fillable = [
        'name', 'password', 'email',
    ];

    public static function getDataById($Id, $select = ['id', 'name', 'email']) {
        return UsersModel::select($select)->where('id', $Id)->get();
    }
}
