<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Misc\City\CityRepository as Cities;

use App\Http\Requests\City\UpdateDataRequest;


/**
 * Class CitiesController
 *
 * @package App\Http\Controllers\Admin
 */
class CitiesController extends Controller {

    /**
     * @var Cities
     */
    private $cityRepo;

	/**
	 * Constructor: inject dependencies.
     *
     * @param Cities $cityRepo
	 */
	public function __construct(Cities $cityRepo)
	{
		$this->cityRepo = $cityRepo;
	}

	/**
	 * 'Cities overview' page.
     *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['cities'] = $this->cityRepo->getAll();

		return view('admin.cities.show', $data);
	}

	/**
	 * Display 'Edit city data' form.
     *
     * @param int $city_id
     *
     * @return \Illuminate\View\View
	 */
	public function edit($city_id)
	{
		$data['city'] = $this->cityRepo->findById($city_id);

		return view('admin.cities.edit', $data);
	}

	/**
	 * Process editing.
     *
     * @param UpdateDataRequest $request
     * @param int $city_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateDataRequest $request, $city_id)
	{
        $request->persist($this->cityRepo, $city_id);

		return redirect('admin/cities/'. $city_id .'/edit');
	}


}