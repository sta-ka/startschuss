<?php namespace App\Models\Applicant\Education;

interface EducationRepository {

    /**
     * Create new education.
     *
     * @param array $data
     *
     * @return static
     */
    public function create($data);

    /**
     * Get education by ID.
     *
     * @param int $education_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findById($education_id);

    /**
     * Get all education by user ID.
     *
     * @param int $applicant_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllById($applicant_id);

}