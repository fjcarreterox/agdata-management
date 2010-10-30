<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package		Fuel
 * @version		1.0
 * @author		Harro "WanWizard" Verton
 * @license		MIT License
 * @copyright	2010 Dan Horrigan
 * @link		http://fuelphp.com
 */

// --------------------------------------------------------------------

class Fuel_Session
{
	/*
	 * loaded session driver instance
	 */
	protected static $instance = NULL;

	/*
	 * list of supported session drivers
	 */
	protected static $valid_storage = array('cookie', 'file');

	// --------------------------------------------------------------------

	/*
	 * class autoload initialisation, and driver instantiation
	 */
	public static function init()
	{
		// do we need to load the driver instance?
		if (is_null(self::$instance))
		{
			// load the session configuration
			Config::load('session', 'session');
			$config = Config::get('session');

			// validate the config, set some defaults if needed
			if ( ! isset($config['type']) OR ! in_array($config['type'], self::$valid_storage))
			{
				throw new Fuel_Exception('You have specified an invalid session storage system.');
			}

			// instantiate the driver
			$driver = 'Session_'.ucfirst($config['type']).'_Driver';
			self::$instance = new $driver();

			// and configure it
			self::$instance->set_config('match_ip', isset($config['match_ip']) ? (bool) $config['match_ip'] : TRUE);
			self::$instance->set_config('match_ua', isset($config['match_ua']) ? (bool) $config['match_ua'] : TRUE);
			self::$instance->set_config('cookie_name', isset($config['cookie_name']) ? (string) $config['cookie_name'] : 'fuelsession');
			self::$instance->set_config('cookie_domain', isset($config['cookie_domain']) ? (string) $config['cookie_domain'] : '');
			self::$instance->set_config('cookie_path', isset($config['cookie_path']) ? (string) $config['cookie_path'] : '/');
			self::$instance->set_config('expiration_time', isset($config['expiration_time']) ? (int) $config['expiration_time'] : 0);
			self::$instance->set_config('rotation_time', isset($config['rotation_time']) ? (int) $config['rotation_time'] : 0);
			self::$instance->set_config('flash_id', isset($config['flash_id']) ? (string) $config['flash_id'] : 'flash');
			self::$instance->set_config('config', isset($config['config']) ? (array) $config['config'] : array());
			self::$instance->set_config('flash_auto_expire', isset($config['flash_auto_expire']) ? (bool) $config['flash_auto_expire'] : TRUE);
		}
	}

	// --------------------------------------------------------------------
	// mapping of the static public methods to the driver instance methods
	// --------------------------------------------------------------------

	/**
	 * set session variables
	 *
	 * @param	string	name of the variable to set
	 * @param	mixed	value
	 * @access	public
	 * @return	void
	 */
	public static function set($name, $value)
	{
		return self::$instance->set($name, $value);
	}

	// --------------------------------------------------------------------

	/**
	 * get session variables
	 *
	 * @access	public
	 * @param	string	name of the variable to get
	 * @return	mixed
	 */
	public static function get($name)
	{
		return self::$instance->get($name);
	}

	// --------------------------------------------------------------------

	/**
	 * delete a session variable
	 *
	 * @param	string	name of the variable to delete
	 * @param	mixed	value
	 * @access	public
	 * @return	void
	 */
	public static function delete($name)
	{
		return self::$instance->delete($name);
	}

	// --------------------------------------------------------------------

	/**
	 * set session flash variables
	 *
	 * @param	string	name of the variable to set
	 * @param	mixed	value
	 * @access	public
	 * @return	void
	 */
	public static function set_flash($name, $value)
	{
		return self::$instance->set_flash($name, $value);
	}

	// --------------------------------------------------------------------

	/**
	 * get session flash variables
	 *
	 * @access	public
	 * @param	string	name of the variable to get
	 * @return	mixed
	 */
	public static function get_flash($name)
	{
		return self::$instance->get_flash($name);
	}

	// --------------------------------------------------------------------

	/**
	 * keep session flash variables
	 *
	 * @access	public
	 * @param	string	name of the variable to keep
	 * @return	void
	 */
	public static function keep_flash($name)
	{
		return self::$instance->keep_flash($name);
	}

	// --------------------------------------------------------------------

	/**
	 * delete session flash variables
	 *
	 * @param	string	name of the variable to delete
	 * @param	mixed	value
	 * @access	public
	 * @return	void
	 */
	public static function delete_flash($name)
	{
		return self::$instance->delete_flash($name);
	}

	// --------------------------------------------------------------------

	/**
	 * create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	public static function create()
	{
		return self::$instance->create();
	}

	// --------------------------------------------------------------------

	/**
	 * read the session
	 *
	 * @access	public
	 * @return	void
	 */
	public static function read()
	{
		return self::$instance->read();
	}

	// --------------------------------------------------------------------

	/**
	 * write the session
	 *
	 * @access	public
	 * @return	void
	 */
	public static function write()
	{
		return self::$instance->write();
	}

	// --------------------------------------------------------------------

	/**
	 * destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	public static function destroy()
	{
		return self::$instance->destroy();
	}

}

/* End of file session.php */
