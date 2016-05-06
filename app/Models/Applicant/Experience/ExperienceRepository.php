<?php namespace App\Models\Applicant\Experience;

interface ExperienceRepository {

    /**
     * Create new experience.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get experience by ID.
     *
     * @param int $experience_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findById($experience_id);

    /**
     * Get all experience by user ID.
     *
     * @param int $applicant_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllById($applicant_id);
}