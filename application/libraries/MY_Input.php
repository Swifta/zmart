<?php defined('SYSPATH') or die('No direct script access.'); 
class Input extends Input_Core {
	public function __construct()
	{	
		$this->use_xss_clean = (bool) Kohana::config('core.global_xss_filtering');
		// Only run this once!
		if (self::$instance === NULL AND $this->use_xss_clean)
		{
			
			// Disable the xss cleaner and copy the data
			$this->use_xss_clean = FALSE;
			$this->raw_data['post'] = $this->clean_input_data($_POST);
			$this->raw_data['get'] = $this->clean_input_data($_GET);
			$this->raw_data['cookie'] = $this->clean_input_data($_COOKIE);

			// Don't forget to turn it back on!
			$this->use_xss_clean = TRUE;
		}
		parent::__construct();
	}
	
	/**
	 * Fetch raw global data
	 *
	 * @param   string   global data name
	 * @param   string   key to find
	 * @param   mixed    default value
	 * @return  mixed
	 */
	 
	public function raw($type = 'post', $key = array(), $default = NULL)
	{
		if(isset($this->raw_data[$type])){
			return $this->search_array($this->raw_data[$type], $key, $default);
		}
	}

} // End Input
