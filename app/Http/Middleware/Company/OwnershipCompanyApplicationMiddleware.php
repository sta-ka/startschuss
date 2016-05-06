<?php namespace App\Http\Middleware\Company;

use Closure;
use App\Models\User\UserRepository as Users;

class OwnershipCompanyApplicationMiddleware {

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
     * Check if the application belongs to the logged-in company user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $event_id       = (int) $request->route()->parameter('event_id');
        $application_id = (int) $request->route()->parameter('application_id');

        if ($this->userRepo->checkApplicationOwnership($event_id, $application_id, \Sentry::getUser()->getId(), 'company') !== 1) {
            notify('error', 'missing_rights', false);
            return \Redirect::to('company/applications');
        }

        return $next($request);
    }

}
