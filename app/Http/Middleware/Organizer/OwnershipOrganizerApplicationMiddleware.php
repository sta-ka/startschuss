<?php namespace App\Http\Middleware\Organizer;

use Closure;
use App\Models\User\UserRepository as Users;

class OwnershipOrganizerApplicationMiddleware {

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
	 * Check if an application belongs to the logged-in organizer user.
	 *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $event_id       = (int) $request->route()->parameter('event_id');
		$application_id = (int) $request->route()->parameter('application_id');

		if ($this->userRepo->checkApplicationOwnership($event_id, $application_id, \Sentry::getUser()->getId(), 'organizer') !== 1) {
            notify('error', 'missing_rights', false);
			return \Redirect::to('organizer/applications');
		}

        return $next($request);
	}
}
