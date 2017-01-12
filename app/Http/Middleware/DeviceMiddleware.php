<?php
namespace App\Http\Middleware;

use Closure;
use App\Common\Traits\DeviceTrait;

class DeviceMiddleware {
    use DeviceTrait;

    public function handle($request, Closure $next, $guard = null) {
        $httpHost = config("set.httpHost");
        $url = $request->url();
        $preg       = "/^http(s)?:\/\/{$httpHost}\/(mobile$)|(mobile\/.*)$/";
        if (preg_match($preg, $url)) {
            if($this->isMobile()){
                return $next($request);
            }else{
                return redirect("/");
            }
        }else{
            if($this->isMobile()){
                return redirect("/mobile");
            }else{
                return $next($request);
            }
        }
    }


}