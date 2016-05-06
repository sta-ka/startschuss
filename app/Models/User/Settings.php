<?php namespace App\Models\User;

use Exception;

class Settings
{
    /**
     * The User instance.
     *
     * @var User
     */
    protected $user;

    /**
     * The list of settings
     *
     * @var array
     */
    protected $settings = [];

    /**
     * Create a new settings instance
     *
     * @param array $settings
     * @param User  $user
     */
    public function __construct($settings, User $user)
    {
        $this->settings = $settings;
        $this->user = $user;
    }

    /**
     * Retrieve the given setting
     *
     * @param  string $key
     * @return string
     */
    public function get($key)
    {
        return array_get($this->settings, $key);
    }

    /**
     * Create and persist a new setting.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->settings[$key] = $value;

        $this->persist();
    }

    /**
     * Determine if the given setting exists.
     *
     * @param  string $key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $this->settings);
    }

    /**
     * Retrieve an array of all settings.
     *
     * @return array
     */
    public function all()
    {
        return $this->settings;
    }

    /**
     * Merge the given attributes with the current settings.
     * But do not assign any new settings.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function merge(array $attributes)
    {
        dd($attributes);
        $this->settings = array_merge(
            $this->settings,
            array_only($attributes, array_keys($this->settings))
        );

        return $this->persist();
    }

    /**
     * Persist the settings.
     *
     * @return mixed
     */
    protected function persist()
    {
        return $this->user->update(['settings' => $this->settings]);
    }

    /**
     * Magic property access for settings.
     *
     * @param  string $key
     * @throws Exception
     *
     * @return string
     */
    public function __get($key)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        throw new Exception("The {$key} setting does not exist.");
    }

    /**
     * Magic property writing for settings.
     *
     * @param  string $key
     * @param  string $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }
}