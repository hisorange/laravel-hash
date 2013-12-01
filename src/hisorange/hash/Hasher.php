<?php
namespace hisorange\hash;

use Illuminate\Config\Repository;
use Illuminate\Hashing\HasherInterface;

class Hasher implements HasherInterface
{
	/**
	 * Store the app's config.
	 *
	 * @type Illuminate\Config\Repository
	 */
	protected $cfg;

	/**
	 * Save configurations.
	 *
	 * @return void
	 */
	public function __construct(Repository $config)
	{
		$this->cfg = $config;
	}

	/**
	 * Generate salt for the current work session.
	 *
	 * @return string
	 */
	protected function generateSessionSalt()
	{
		return substr(str_shuffle(str_repeat($this->cfg->get('laravel-hash::salt_alphabet'), 6)), 0, $this->cfg->get('laravel-hash::salt_length'));
	}

	/**
	 * Hash a string value with the predefined algorithm.
	 *
	 * @return string
	 */
	public function make($value, array $options = array())
	{
		// Generate different salt for every hashing.
		$sessionSalt = $this->generateSessionSalt();

		return $sessionSalt.hash($this->cfg->get('laravel-hash::algorithm'), $this->cfg->get('app.salt').$value.$sessionSalt);
	}

	/**
	 * Check a value against it's hashed format.
	 *
	 * @return boolean
	 */	
	public function check($value, $hashedValue, array $options = array())
	{
		// Get the hashing salt.
		$sessionSalt 	= substr($hashedValue, 0, $this->cfg->get('laravel-hash::salt_length'));

		return ($hashedValue == $sessionSalt.hash($this->cfg->get('laravel-hash::algorithm'), $this->cfg->get('app.salt').$value.$sessionSalt));
	}

	/**
	 * Compability for the interface.
	 *
	 * @return boolean
	 */
	public function needsRehash($hashedValue, array $options = array()){return false;}
}