<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;
use App\Http\Requests\HandleImage;

class UploadLogoRequest extends Request {

    use HandleImage;

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
     * @param object   $organizerRepo
     * @param int      $organizer_id
     *
     * @return bool|int
     */
    public function persist($organizerRepo, $organizer_id)
    {
        $organizer = $organizerRepo->findById($organizer_id);

        $filename = $this->createFilename($organizer);

        // resize images and save them
        $this->uploadImage(\Input::file('logo'), 250, 125, 'uploads/logos/big/' . $filename);
        $this->uploadImage(\Input::file('logo'), 100, 50, 'uploads/logos/medium/' . $filename);
        $this->uploadImage(\Input::file('logo'), 50, 25, 'uploads/logos/small/' . $filename);

        \Input::file('logo')->move('uploads/logos/original/', $filename);

        return $organizer->update(['logo' => $filename]);
    }
}
