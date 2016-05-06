<?php namespace App\Http\Middleware\Organizer;

use Closure;
use App\Models\User\UserRepository as Users;

class OwnershipEventMiddleware {

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
	 * Check if an event belongs to the logged-in user
	 * include all events or only upcoming events.
	 *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  bool  $all
     * @return mixed
	 */
	public function handle($request, Closure $next, $all = null)
	{
        if ($all == 'all') {
            $all = true;
        }

        $event_id = (int) $request->route()->parameter('event_id');

        if ($this->userRepo->checkEventOwnership($event_id, \Sentry::getUser()->getId(), $all) !== 1){
            notify('error', 'missing_rights', false);
			return \Redirect::to('organizer/profile');
		}

        return $next($request);
	}


}
