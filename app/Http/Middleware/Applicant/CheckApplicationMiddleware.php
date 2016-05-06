<?php namespace App\Http\Middleware\Applicant;

use Closure;
use App\Models\User\UserRepository as Users;

class CheckApplicationMiddleware {

    /**
     * @var Users
     */
    private $userRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Users $userRepo
     */
    public function __construct(Users $userRepo)
    {
        $this->userRepo = $userRepo;
    }

	/**
	 * Check if logged-in user already applied for the company at the given event.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
     *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $event_id   = (int) $request->route()->parameter('event_id');
		$company_id = (int) $request->route()->parameter('company_id');

		// checks if user already sent an application for the company at the given event
		if ($this->userRepo->checkForApplication(\Sentry::getUser()->getId(), $event_id, $company_id) !== 0) {
			notify('error', 'missing_rights', false);
			return \Redirect::to('applicant/dashboard');
		}

		return $next($request);
	}

}

