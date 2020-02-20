<?php

require_once dirname(__FILE__) . '/OAuthException2.php';

class OAuthStore
{
	static private $instance = false;

	/**
	 * Request an instance of the OAuthStore
	 */
	public static function instance ( $store = 'MySQL', $options = array() )
	{
	    if (!OAuthStore::$instance)
	    {
			// Select the store you want to use
			if (strpos($store, '/') === false)
			{
				$class = 'OAuthStore'.$store;
				$file  = dirname(__FILE__) . '/store/'.$class.'.php';
			}
			else
			{
				$file  = $store;
				$store = basename($file, '.php');
				$class = $store;
			}

			if (is_file($file))
			{
				require_once $file;
				
				if (class_exists($class))
				{
					OAuthStore::$instance = new $class($options);
				}
				else
				{
					throw new OAuthException2('Could not find class '.$class.' in file '.$file);
				}
			}
			else
			{
				throw new OAuthException2('No OAuthStore for '.$store.' (file '.$file.')');
			}
	    }
	    return OAuthStore::$instance;	
	}
}


?>