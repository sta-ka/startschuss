<?php namespace App\Http\Middleware\Company;

use Closure;
use App\Models\User\UserRepository as Users;

class CheckCompanyMiddleware {

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
     * Check if user is linked to a company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->userRepo->checkForCompany(\Sentry::getUser()->getId()) !== 1) {
            notify('error', 'missing_rights', false);
            return \Redirect::to('company/dashboard');
        }

        return $next($request);
    }

}
