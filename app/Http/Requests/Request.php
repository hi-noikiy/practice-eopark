<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {
    public function rules() {
        return [
            'first_name' => 'required',
            'email_address' => 'required|email'
        ];
    }

    public function authorize() {
        // 只允许登陆用户
        // 返回 \Auth::check();
        // 允许所有用户登入
        return true;
    }

    // 可选: 重写基类方法
    public function forbiddenResponse() {
        // 这个是可选的, 当认证失败时返回自定义的 HTTP 响应.
        // (框架默认的行为是带着错误信息返回到起始页面)
        // 可以返回 Response 实例, 视图, 重定向或其它信息
        return Response::make('Permission denied foo!', 403);
    }

    // 可选: 重写基类方法
    public function response() {
        // 如果需要自定义在验证失败时的行为, 可以重写这个方法
        // 了解有关基类中这个方法的默认行为,可以查看:
        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
    }
}
