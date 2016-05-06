<?php namespace App\Http\Middleware\Applicant;

use Closure;
use App\Models\Event\EventRepository as Events;

class OffersApplicationsMiddleware {

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Events $eventRepo
     */
    public function __construct(Events $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

	/**
	 * Check if a company offers interviews at an event.
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

        $event = $this->eventRepo->findById($event_id);

        // redirect back if applications are closed
        if ($event->applications_closed == true) {
            notify('error', 'missing_rights', false);
            return \Redirect::to('applicant/applications/show');
        }

        // redirect back if company does not participate in given event
        if ( ! $event->participants->contains($company_id)) {
            notify('error', 'missing_rights', false);
            return \Redirect::to('applicant/applications/show');
        } else {
            $participant = $event->participants->find($company_id);

            // redirect back if company does not offer interviews
            if ($participant->pivot->interview == false) {
                notify('error', 'missing_rights', false);
                return \Redirect::to('applicant/applications/show');
            }
        }

        return $next($request);
    }

}
