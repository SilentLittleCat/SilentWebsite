<?php

namespace App\Http\Middleware;

use Closure;
use Debugbar;
use DB;

class RedirectIfUserNotFound
{
    private $redirecTo = '/';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = DB::table('users')->where('id', $request->id)->get();

        if($user->count() <= 0) {
            return redirect($this->redirecTo);
        }
        return $next($request);
    }
}
