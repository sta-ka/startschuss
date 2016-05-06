<?php namespace App\Http\Requests\Experience;

use App\Http\Requests\Request;

class UpdateExperienceRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'company' 			=> 'required',
			'industry' 			=> 'required',
			'job_description' 	=> 'required',
			'month_start' 		=> 'numeric|between:1,12',
			'year_start' 		=> 'numeric|min:1980|max:' . date('Y'),
			'month_end' 		=> 'numeric|between:0,12',
			'year_end'	 		=> 'numeric|min:0|max:' . date('Y'),
			'to_date'			=> 'in:0,1'
		];

        if (! $this->isValidStartDate()) {
            $rules['valid_start_date'] = 'required';
        }

        if (! $this->isValidEndDate()) {
            $rules['valid_end_date'] = 'required';
        }

        if ($this->isValidEndDate() && $this->isValidEndDate()) {
            $start_date = $this->computeStartDate();
            $end_date   = $this->computeEndDate();

            if (strtotime($end_date) < strtotime($start_date)) {
                $rules['valid_start_date'] = 'required';
            }
        }

		return $rules;
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
			'2030-01-01' :
			\Date::germanToSql('01.' . \Input::get('month_end') . '.' . \Input::get('year_end'));
	}

}
