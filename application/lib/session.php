<?php

//'Wrapper' class for session
class Session
{

	//'flag' to check if session is started
	private static $_sessionStarted = false;

	//start session if previously not started
	public static function _start()
	{
		if(self::$_sessionStarted === false)
		{
			session_start();
			self::$_sessionStarted = true;
		}
	}

	//sets the value of the session key
	public static function _set($value, $key, $key2 = false)
	{
		if($key2 === false){
			$_SESSION[$key] = $value;
		}
		else{
			$_SESSION[$key][$key2] = $value;
		}
	}

	//gets the value of the session key
	public static function _get($key, $key2 = false)
	{
		if($key2 === false)
		{
			return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
		}
		else
		{
			return (isset($_SESSION[$key][$key2])) ? $_SESSION[$key][$key2] : false;
		}
	}

	//check if specific session key is set
	public static function _isset($key, $key2 = false)
	{
		if($key2 === false)
		{
			return (isset($_SESSION[$key])) ? true : false;
		}
		else
		{
			return (isset($_SESSION[$key][$key2])) ? true : false;
		}
	}

	//display session data on screen (for debugging)
	public static function _display()
	{
		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';
	}

	//destroys the session
	public static function _destroy()
	{
		if(self::$_sessionStarted === true)
		{
			session_unset();
			session_destroy();
		}
	}

	//unsets specific session key
	public static function _unset($key, $key2 = false)
	{
		if(self::$_sessionStarted == true)
		{
			if($key2 === false)
			{
				if(isset($_SESSION[$key]))
				{
					unset($_SESSION[$key]);
				}
			}
			else
			{
				if(isset($_SESSION[$key][$key2]))
				{
					unset($_SESSION[$key][$key2]);
				}
			}
		}
	}
}

?>