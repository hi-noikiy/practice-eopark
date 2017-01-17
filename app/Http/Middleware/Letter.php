<?php

namespace App\Http\Middleware;


use App\Repositories\LettersRep;
use Closure;
use Illuminate\Support\Facades\Auth;

class Letter {

    public function handle($request, Closure $next) {
        session()->forget('unreadLetterNum');
        if (Auth::check()) {
            $number = LettersRep::getUnreadNum(Auth::id());
            if ($number != 0) {
                session()->flash('unreadLetterNum', $number);
            }
        }
        return $next($request);
    }
}