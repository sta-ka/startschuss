<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Misc\Region\RegionRepository as Regions;

use App\Http\Requests\Region\UpdateDataRequest;

/**
 * Class RegionsController
 *
 * @package App\Http\Controllers\Admin
 */
class RegionsController extends Controller {

    /**
     * @var Regions
     */
    private $regionRepo;

	/**
	 * Constructor: inject dependencies.
     *
     * @param Regions $regionRepo
	 */
	public function __construct(Regions $regionRepo)
	{
		$this->regionRepo = $regionRepo;
	}

	/**
	 * Regions Overview.
     *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['regions'] = $this->regionRepo->getAll();

		return view('admin.regions.show', $data);
	}

	/**
	 * Display 'Edit Region data' form.
     *
     * @param int $region_id
     *
     * @return \Illuminate\View\View
	 */
	public function edit($region_id)
	{
		$data['region'] = $this->regionRepo->findById($region_id);

		return view('admin.regions.edit', $data);
	}

	/**
	 * Process editing.
     *
     * @param UpdateDataRequest $request
     * @param int $region_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateDataRequest $request, $region_id)
	{
        $request->persist($this->regionRepo, $region_id);

		return redirect('admin/regions/'. $region_id .'/edit');
	}


}