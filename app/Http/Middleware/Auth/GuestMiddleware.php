<?php namespace App\Http\Middleware\Auth;

use Closure;

class GuestMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Sentry::check()) {
            notify('error', 'already_logged_in', false);
            return \Redirect::to('home');
        }
        return $next($request);
    }

}
