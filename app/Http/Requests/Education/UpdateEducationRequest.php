<?php namespace App\Http\Requests\Education;

use App\Http\Requests\Request;

class UpdateEducationRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'university' 		=> 'required',
			'branch_of_study' 	=> 'required',
			'key_aspects' 		=> 'required',
			'month_start' 		=> 'numeric|between:1,12',
			'year_start' 		=> 'numeric|min:1980|max:'.date('Y'),
			'month_end' 		=> 'numeric|between:0,12',
			'year_end'	 		=> 'numeric|min:0|max:'.date('Y'),
			'to_date'			=> 'in:0,1'
		];

        if (! $this->isValidStartDate()) {
            $rules['valid_start_date'] = 'required';
        }

        if (! $this->isValidEndDate()) {
            $rules['valid_end_date'] = 'required';
        }

        if ($this->isValidStartDate() && $this->isValidEndDate()) {
            $start_date = $this->computeStartDate();
            $end_date   = $this->computeEndDate();

            if (strtotime($end_date) < strtotime($start_date)) {
                $rules['valid_start_date'] = 'required';
            }
        }

		return $rules;
	}

    /**
     * Persist data.
     *
     * @param object   $educationRepo
     * @param int      $education_id
     *
     * @return bool|int
     */
    public function persist($educationRepo, $education_id)
    {
        $education = $educationRepo->findById($education_id);

        $data = [
            'university'		=> $this->request->get('university'),
            'branch_of_study'	=> $this->request->get('branch_of_study'),
            'key_aspects'		=> $this->request->get('key_aspects'),
            'to_date'			=> \Input::get('to_date') ? $this->request->get('to_date') : 0,
            'month_start'		=> $this->request->get('month_start'),
            'year_start'		=> $this->request->get('year_start'),
            'month_end'			=> \Input::get('to_date') ? 0 : $this->request->get('month_end'),
            'year_end'			=> \Input::get('to_date') ? 0 : $this->request->get('year_end'),
            'start_date'		=> \Date::germanToSql('01.' . $this->request->get('month_start') .'.'. $this->request->get('year_start')),
            'end_date'			=> \Input::get('to_date') ? '2030-01-16' : \Date::germanToSql('16.'. $this->request->get('month_end') .'.'. $this->request->get('year_end'))
        ];

        return $education->update($data);
    }

	/**
	 * @return bool
	 */
	private function isValidStartDate()
	{
		return checkdate(\Input::get('month_start'), 1, \Input::get('year_start'));
	}

	/**
	 * @return bool
	 */
	private function isValidEndDate()
	{
		return (\Input::get('month_end') && \Input::get('year_end')) || \Input::get('to_date');
	}

	/**
	 * @return string
	 */
	private function computeStartDate()
	{
		return \Date::germanToSql('01.' . \Input::get('month_start') . '.' . \Input::get('year_start'));
	}

	/**
	 * @return string
	 */
	private function computeEndDate()
	{
		return \Input::get('to_date') ?
			'2030-01-16' :
			\Date::germanToSql('16.' . \Input::get('month_end') . '.' . \Input::get('year_end'));
	}

}
