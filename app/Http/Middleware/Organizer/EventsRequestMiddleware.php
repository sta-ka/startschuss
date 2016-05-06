<?php namespace App\Http\Middleware\Organizer;

use Closure;
use App\Models\Event\EventRepository as Events;

class EventsRequestMiddleware {

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
     * Check if organizer user already has two or more open requested events.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->eventRepo->getRequestedEvents(\Sentry::getUser()->getId())->count() >= 2) {
            notify('error', 'missing_rights', false);
			return \Redirect::to('organizer/profile');
		}

        return $next($request);
	}
}
