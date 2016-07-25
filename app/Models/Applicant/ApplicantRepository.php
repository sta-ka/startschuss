<?php namespace App\Models\Applicant;

interface ApplicantRepository {

    /**
     * Create a new applicant.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get all applicants.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll();

    /**
     * Get applicant by ID.
     *
     * @param int $applicant_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($applicant_id);

    /**
     * Get applicant by User ID.
     *
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByUserId($user_id);

}