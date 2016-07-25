<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Organizer\OrganizerRepository as Organizers;

/**
 * Class OrganizersController
 *
 * @package App\Http\Controllers\Frontend
 */
class OrganizersController extends Controller {

    /**
     * @var Organizers
     */
    private $organizerRepo;

	/**
	 * Constructor: inject dependencies.
     *
     * @param Organizers $organizerRepo
	 */
	public function __construct(Organizers $organizerRepo)
	{
		$this->organizerRepo = $organizerRepo;
	}

	/**
	 * Display all organizers or filters organizers by first letter.
     *
     * @param string $str
     *
     * @return \Illuminate\View\View
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
	 */
	public function veranstalterdatenbank($str = null)
	{
		if ( ! $str) {
			$data['organizers'] = $this->organizerRepo->getPaginatedOrganizers(15);
        } elseif (strlen($str) == 1 && in_array($str, str_split('abcdefghijklmnopqrstuvwxyz'))) {
            $data['organizers'] = $this->organizerRepo->getByLetter($str);
        } else {
            abort(404);
        }

        return view('start.organizers', $data);
    }

	/**
	 * Organizer detail page - Display organizer info if it exists.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     *
     * @throws ModelNotFoundException
	 */
	public function veranstalter($slug)
	{
        try {
            $data['organizer']  = $this->organizerRepo->findBySlug($slug);
            $data['events'] 	= $this->organizerRepo->getEventsForOrganizer($data['organizer']->id);

            return view('start.organizer', $data);
        } catch (ModelNotFoundException $e) {
            notify('error', 'organizer_not_found', false);
            abort(404);
        }
	}
}