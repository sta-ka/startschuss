<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;
use App\Http\Requests\HandleImage;


class UploadLogoRequest extends Request {

    use HandleImage;

    protected $dontFlash = ['logo'];

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'logo' => 'required|image|max:1000',
		];
	}

    /**
     * Persist data.
     *
     * @param object    $eventRepo
     * @param int       $event_id
     *
     * @return bool|int
     */
    public function persist($eventRepo, $event_id)
    {
        $event = $eventRepo->findById($event_id);

        $filename = $this->createFilename($event);

        // resize image and save it
        $this->uploadImage(\Input::file('logo'), 60, 30, 'uploads/logos/small/' . $filename);

        \Input::file('logo')->move('uploads/logos/original/', $filename);

        // Save logo in the database
        return $event->update(['logo' => $filename]);
    }

}
