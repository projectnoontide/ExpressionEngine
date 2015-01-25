<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license		http://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine Config Class
 *
 * @package		ExpressionEngine
 * @subpackage	Core
 * @category	Core
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class View {

	public $alerts = array();
	public $blocks = array();

	protected $_theme = 'default';
	protected $_extend = '';
	protected $_data = array();
	protected $_disabled = array();
	protected $_disable_up = array();

	/**
	 * Set Theme
	 *
	 * @access public
	 * @return void
	 */
	public function set_cp_theme($cp_theme)
	{
		$this->_theme = $cp_theme;
		ee()->session->userdata['cp_theme'] = $cp_theme;

		// root overrides deprecated in 2.9.1, view overrides should be in
		// /views/ henceforth
		ee()->load->add_theme_cascade(PATH_CP_THEME);
		ee()->load->add_theme_cascade(PATH_CP_THEME.'views/');
	}

	// --------------------------------------------------------------------

	/**
	 * Render output (html)
	 *
	 * @access public
	 * @return void
	 */
	public function render($view, $data = array(), $return = FALSE)
	{
		ee()->load->helper('view_helper');
		ee()->javascript->compile();

		$data = array_merge($this->_data, $data);
		$data['blocks'] = $this->blocks;
		$data['localize'] = ee()->localize;

		// load up the inner
		$rendered_view = ee()->load->view($view, $data, TRUE);

		// traverse up the extensions
		// we stop passing other data - it's cached in the loader
		while ($this->_extend)
		{
			$view = $this->_extend;
			$this->_extend = '';
			$this->disable($this->_disable_up);
			$data = array(
				'EE_rendered_view' => $rendered_view,
				'blocks'           => $this->blocks
			);
			$rendered_view = ee()->load->view($view, $data, TRUE);
		}

		// clear for future calls
		$this->_clear();

		if ($return)
		{
			return $rendered_view;
		}

		ee()->output->set_output($rendered_view);
	}

	// --------------------------------------------------------------------

	/**
	 * Extend a template or view
	 *
	 * @access public
	 * @return void
	 */
	public function extend($which, $disable)
	{
		$this->_extend = $which;

		if ( ! is_array($disable))
		{
			$disable = array($disable);
		}

		$this->_disable_up = $disable;
	}

	// --------------------------------------------------------------------

	/**
	 * Disable a view feature
	 *
	 * @access public
	 * @return void
	 */
	public function disable($which)
	{
		if ( ! is_array($which))
		{
			$which = array($which);
		}

		while ($el = array_pop($which))
		{
			$this->_disabled[] = $el;
		}

		$this->_disable_up = array();
	}

	// --------------------------------------------------------------------

	/**
	 * Check if a view featuer is disabled
	 *
	 * @access public
	 * @return void
	 */
	public function disabled($which)
	{
		return in_array($which, $this->_disabled);
	}

	// --------------------------------------------------------------------

	/**
	 * Head Title
	 *
	 * This tag generates an HTML Title Tag
	 */
	public function head_title($title)
	{
		return '<title>' . $title . ' | ExpressionEngine</title>'.PHP_EOL;
	}

	// --------------------------------------------------------------------

	/**
	 * Script tag
	 *
	 * This function will return a script tag for use the control panel.  It will
	 * include a v= query string with the filemtime, so farfuture expires headers
	 * can be sent
	 *
	 * @param 	string		Javascript File, relative to themes/javascript/<src/compressed>/jquery
	 * @return 	string 		script tag
	 */
	public function script_tag($file)
	{
		$src_dir = (ee()->config->item('use_compressed_js') == 'n') ? 'src/' : 'compressed/';

		$path = PATH_THEMES.'javascript/'.$src_dir.$file;

		if ( ! file_exists($path))
		{
			return NULL;
		}

		$filemtime = filemtime($path);

		$url = URL_THEMES . 'javascript/' . $src_dir . $file . '?v=' . $filemtime;

		return '<script type="text/javascript" src="' . $url . '"></script>'.PHP_EOL;
	}

	// --------------------------------------------------------------------

	/**
	 * Head Link
	 *
	 * This function will produce a URL to a css stylesheet, and include the filemtime() so
	 * far-future expires headers can be sent on CSS by the user.
	 *
	 * @param 	string		CSS file, relative to the themes/cp_themes/<theme> directory.
	 * @param	string		produces "media='screen'" by default
	 * @return 	string		returns the link string.
	 */
	public function head_link($file, $media = 'screen')
	{
		$filemtime = NULL;
		$file_url  = NULL;

		$css_paths = array(
			$this->_theme => PATH_CP_THEME,
			'default'     => PATH_THEMES.'cp_themes/default/'
		);

		foreach($css_paths as $theme => $path)
		{
			if (file_exists($path.$file))
			{
				$filemtime = filemtime($path.$file);
				$base_url  = ($theme == 'default') ? URL_THEMES : URL_ADDONS_THEMES;
				$file_url  = $base_url.'cp_themes/'.$theme.'/'.$file;
				break;
			}
		}

		if ($file_url === NULL)
		{
			return NULL;
		}

		return '<link rel="stylesheet" href="'.$file_url.'?v='.$filemtime.'" type="text/css" media="'.$media.'" />'.PHP_EOL;
	}

	// --------------------------------------------------------------------

	/**
	 * Sets success or error message to display on page load
	 *
	 * This function will gather messages that need to appear in the inline
	 * alert box in the CP. Think of the messages like a git commit: summary
	 * in the headline (title), more detail in the body (description).
	 *
	 * @param 	string	$type			'success', 'warn', or 'issue'
	 * @param	string	$title			Title of message
	 * @param 	string	$description	More detailed message
	 * @param 	bool	$flashdata		Whether or not to persist this message
	 * 		                      		in flashdata for the next page load
	 * @return 	void
	 */
	public function set_message($type, $title, $description = '', $flashdata = FALSE)
	{
		if (is_array($description))
		{
			$description = implode('<br>', $description);
		}

		$message_array = array('type' => $type, 'title' => $title, 'description' => $description);

		$this->set_alert('inline', $message_array, $flashdata);
	}

	// --------------------------------------------------------------------

	/**
	 * Populates the alerts view array based on the alert type
	 *
	 * @param	string	$type		'standard', 'inline', or 'banner'
	 * @param	array	$alert_data	An array with keys 'type', 'title', and 'description'
	 * @param 	bool	$flashdata	Whether or not to persist this message
	 * 		                      	in flashdata for the next page load
	 * @return 	void
	 */
	public function set_alert($type, array $alert_data, $flashdata = FALSE)
	{
		$alert = ee('Alert')->make('shared-form', strtolower($type))
			->withTitle($alert_data['title'])
			->addToBody($alert_data['description']);

		switch ($alert_data['type'])
		{
			case 'issue':
				$alert->asIssue();
				break;

			case 'success':
				$alert->asSuccess();
				break;

			case 'warn':
				$alert->asWarning();
				break;
		}

		if ($flashdata)
		{
			$alert->defer();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Sets variables for defining a meta-refresh tag
	 *
	 * @param	string	$url	The URL to refresh to
	 * @param	int		$rate	The refresh rate
	 *
	 * @return void
	 */
	public function set_refresh($url, $rate, $flashdata = FALSE)
	{
		$refresh = array('url' => $url, 'rate' => $rate);
		if ($flashdata)
		{
			ee()->session->set_flashdata('meta-refresh', $refresh);
		}
		else
		{
			ee()->view->meta_refresh = $refresh;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get themes URL from supplied system path
	 *
	 * this function will extract which theme we will be loading the file from.
	 *
	 * @access protected
	 * @param 	string	system path of the file.
	 * @return 	string	the URL
	 */
	protected function _get_theme_from_path($path)
	{
		$path = '/'.trim($path, '/');

		$theme_name = ltrim(strrchr($path, '/'), '/');

		return ee()->config->item('theme_folder_url') . 'cp_themes/' . $theme_name . '/';
	}

	// --------------------------------------------------------------------

	/**
	 * Clear the class
	 *
	 * @access protected
	 * @return void
	 */
	protected function _clear()
	{
		$this->_extend = '';
		$this->_data = array();
		$this->_disabled = array();
		$this->_disable_up = array();
	}

	// --------------------------------------------------------------------
	// Template Data Getters and Setters
	// --------------------------------------------------------------------

	public function __set($key, $value)
	{
		$this->_data[$key] = $value;
	}

	public function __get($key)
	{
		return isset($this->_data[$key]) ? $this->_data[$key] : NULL;
	}

	public function __isset($key)
	{
		return isset($this->_data[$key]);
	}

	public function __unset($key)
	{
		unset($this->_data[$key]);
	}
}
