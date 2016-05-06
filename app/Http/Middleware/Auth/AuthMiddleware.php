<?php namespace App\Http\Middleware\Auth;

use Closure;

class AuthMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string  $role
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role)
	{
		$user = \Sentry::getUser();

        if (! \Sentry::check()) {
            notify('error', 'access_denied', false);
            return \Redirect::to('home');
        }

        if ($role && ! $user->inGroup(\Sentry::findGroupByName($role))) {
            notify('error', 'access_denied', false);
            return \Redirect::to('home');
        }

		return $next($request);
	}

}
