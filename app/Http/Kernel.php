<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

    /**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' 	                => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'auth' 			                => 'App\Http\Middleware\Auth\AuthMiddleware',
        'guest' 	    	            => 'App\Http\Middleware\Auth\GuestMiddleware',

        'check.application'		        => 'App\Http\Middleware\Applicant\CheckApplicationMiddleware',
        'offers.applications'           => 'App\Http\Middleware\Applicant\OffersApplicationsMiddleware',

        'check.company'		            => 'App\Http\Middleware\Company\CheckCompanyMiddleware',
        'ownership.company.application' => 'App\Http\Middleware\Company\OwnershipCompanyApplicationMiddleware',
        'ownership.company'             => 'App\Http\Middleware\Company\OwnershipCompanyMiddleware',
        'ownership.job'                 => 'App\Http\Middleware\Company\OwnershipJobMiddleware',

        'ownership.event'		            => 'App\Http\Middleware\Organizer\OwnershipEventMiddleware',
        'ownership.organizer.application'   => 'App\Http\Middleware\Organizer\OwnershipEventMiddleware',
        'events.request'                    => 'App\Http\Middleware\Organizer\EventsRequestMiddleware',
    ];

}
