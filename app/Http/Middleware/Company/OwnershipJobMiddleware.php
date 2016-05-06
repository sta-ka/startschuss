<?php namespace App\Http\Middleware\Company;

use Closure;
use App\Models\User\UserRepository as Users;

class OwnershipJobMiddleware {

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
     * Check if a job belongs to the logged-in company user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $job_id = (int) $request->route()->parameter('job_id');

        if ($this->userRepo->checkJobOwnership($job_id, \Sentry::getUser()->getId()) !== 1) {
            notify('error', 'missing_rights', false);
            return \Redirect::to('company/jobs');
        }

        return $next($request);
    }

}
