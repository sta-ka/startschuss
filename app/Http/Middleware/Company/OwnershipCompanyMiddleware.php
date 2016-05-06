<?php namespace App\Http\Middleware\Company;

use Closure;
use App\Models\User\UserRepository as Users;

class OwnershipCompanyMiddleware {

    /**
     * @var Users
     */
    private $userRepo;

    /**
     * Constructor: inject dependencies
     *
     * @param Users $userRepo
     */
    public function __construct(Users $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Check if company belongs to the logged-in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $company_id = (int) $request->route()->parameter('company_id');

        if ($this->userRepo->checkCompanyOwnership($company_id, \Sentry::getUser()->getId()) !== 1) {
            notify('error', 'missing_rights', false);
            return \Redirect::to('company/dashboard');
        }

        return $next($request);
    }

}
