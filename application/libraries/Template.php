<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CLASS TEMPLATE
 * https://github.com/danieltorscho/CI_Template_lib
 *
 * Simple template library with some core functionalities to simplify development process for CodeIgniter 2.x
 *
 * @package	CodeIgniter
 * @subpackage	CodeIgniter Library
 * @author	Daniel Torscho
 * @copyright	Copyright (c) 2014, DanielTorscho.com
 * @license	The MIT License (MIT) - https://github.com/danieltorscho/CI_Template_lib/blob/master/LICENSE
 * @link	https://github.com/danieltorscho/CI_Template_lib
 *
 * @docs	https://github.com/danieltorscho/CI_Template_lib/blob/master/README.md
 */
class Template{

	/**
	 * CodeIgniter's global object instance holder
	 */
	private $CI;

	/**
	 * Template data array holds the items in an array to access them in subloaded view
	 *
	 * @var array
	 */
	public static $template_data = array();

	/**
	 * Hold the scripts for header
	 *
	 * @var array
	 */
	private $scripts_head = array();

	/**
	 * Hold the scripts for footer
	 *
	 * @var array
	 */
	private $scripts_foot = array();

	/**
	 * Hold an array of stylesheets
	 *
	 * @var array
	 */
	private $stylesheets = array();

	/**
	 * Pagetitle & Pagename holder
	 *
	 * @var    string
	 */
	private $title;

	/**
	 * Segmented array of breadcrumbs
	 *
	 * @var array
	 */
	private $breadcrumbs = array();

	/**
	 * Default template which should be the subview wrapped into
	 *
	 * @var string
	 */
	private $template_default = '';

	/**
	 * @var string Default variable in which the view should be passed to
	 */
	private $content_view = 'tpl_view';

	/**
	 * Default class settings
	 */
	public function __construct()
	{
		// Get a CI Global Instance
		$this->CI =& get_instance();

		// Load neccessary helpers
		$this->CI->load->helper('inflector');

		// Read default js and work them out with script function
		foreach( $this->CI->config->item('tpl_default_js') as $key => $value ){
			$this->script($key, $value);
		}

		// Read default stylesheets from configuration file
		foreach( $this->CI->config->item('tpl_default_css') as $key => $value ){
			$this->css($key, $value);
		}
	}

	/**
	 * Function which populates the template's data. It sets the items so they can be easily
	 * accessed inside all subloaded view files.
	 *
	 * @param string $key   Make the variables accessible inside the subloaded views as: $name.
	 * @param mixed  $value Returns a value.
	 *
	 * @return $this
	 */
	public function set_item( $key, $value )
	{
		return self::$template_data[ $key ] = $value;
	}

	/**
	 * Add custom script to current view.
	 * 
	 * @param string $src
	 * @param bool   $header
	 */
	public function script( $src = '', $header = FALSE )
	{

		if( $header === TRUE ){
			$this->scripts_head[ ] = $src;
			$this->set_item('tpl_scripts_head', $this->scripts_head);
		}else{
			$this->scripts_foot[ ] = $src;
			$this->set_item('tpl_scripts_foot', $this->scripts_foot);
		}

	}

	/**
	 * Add custom stylesheet to current view.
	 *
	 * @param string $src
	 * @param string $type
	 */
	public function css( $src = '', $type = '' )
	{
		$this->stylesheets[ $src ] = $type;
		$this->set_item('tpl_stylesheets', $this->stylesheets);
	}

	/**
	 * Works the Page Title and the Page Name out and creates two variables for shared views.
	 *
	 * @param string $string Catches the title, if empty, creates from `tpl_sitename`.
	 */
	public function title( $string = '' )
	{
		// Check if `tpl_sitename` is available, if not, create a "CMS" string
		if( $this->CI->config->item('tpl_sitename') == '' ){
			$this->CI->config->set_item('tpl_sitename', 'CMS');
		}

		// Check if string is empty or not
		if( $string == '' ){

			// If method name is other than "index", then concatenate the method name
			if( $this->CI->router->method == 'index' ){
				$this->title = $this->CI->router->class;
			}else{
				$this->title = $this->CI->router->method . ' - ' . $this->CI->router->class;
			}

			// Make newly created title readable
			$this->title = humanize($this->title);

			// Catch the pagetitle at the current state and set it to the `tpl_pagename`
			$this->set_item('tpl_pagename', $this->title);

			// Mix pagetitle with sitename properly
			$this->title = $this->title . $this->CI->config->item('tpl_title_separator') . $this->CI->config->item('tpl_sitename');

			// Set item
			$this->set_item('tpl_pagetitle', $this->title);
		}else{
			// Workout the pagetitle
			$this->title = $string . $this->CI->config->item('tpl_title_separator') . $this->CI->config->item('tpl_sitename');

			// Set item
			$this->set_item('tpl_pagetitle', $this->title);
			$this->set_item('tpl_pagename', $string);
		}
	}


	/**
	 * Handle the breadcrumbs creations of segmented items
	 *
	 * @param string $title		Title of the segmented breadcrumb
	 * @param string $link		URL Link
	 * @param bool   $extend	Whenever you need to extend the base crumbs. By default FALSE (turned off)
	 *
	 * @return $this
	 */
	public function crumb( $title = '', $link = '', $extend = FALSE )
	{
		// If no title provided, load the default values from class and method names
		if( $title == '' ){
			// Add first segment based on class name
			$this->breadcrumbs[ $this->CI->router->class ] = humanize($this->CI->router->class);
			// Append a method segment only if method name isn't equal to index()
			if( $this->CI->router->method != 'index' ){
				$this->breadcrumbs[ $this->CI->router->class . '/' . $this->CI->router->method ] = humanize($this->CI->router->method);
			}
		}else{
			if( $extend === TRUE ){
				// Add first segmend based on class name
				$this->breadcrumbs[ $this->CI->router->class ] = humanize($this->CI->router->class);
				// Append a method segment only if method name isn't equal to index()
				if( $this->CI->router->method != 'index' ){
					$this->breadcrumbs[ $this->CI->router->class . '/' . $this->CI->router->method ] = humanize($this->CI->router->method);
				}
			}

			// Add provided segment
			$this->breadcrumbs[ $link ] = $title;
		}

		// Return a setted item for use in global scope
		return $this->set_item('tpl_breadcrumbs', $this->breadcrumbs);
	}

	/**
	 * Render the final output. Provide a variable to load a custom, other than default one template
	 *
	 * @param string $template Custom template wrapper
	 * @param string $view     View name to load inside the $template
	 * @param bool   $return   Determine how the results should be returned. FALSE means as data, TRUE as html
	 *
	 * @return mixed Creates a view with a subloaded $view_data
	 */
	public function render( $template = '', $view = '', $return = FALSE )
	{
		// Initialize the title only if $this->template->title() wasn't called in controller
		if( is_null($this->title) ){
			$this->title();
		}

		// Initialize the breadcrumbs only if $this->template->crumb() wasn't called in controller
		if( empty($this->breadcrumbs) ){
			$this->crumb();
		}

		// Set a key item $view and assign a view to it as by returning the output
		$this->set_item($this->content_view, $this->CI->load->view($view, self::$template_data, TRUE));

		// Return the correctly subloaded view file and wrapped into the defined custom template
		return $this->CI->load->view($template, self::$template_data, $return);
	}

	/**
	 * Function just takes the defined $view and loads it inside the default template which is automatically defined
	 * within the configuration file.
	 * If $this->template->load() is called without any params, it will search for a controller_name/method_name.php
	 * inside the app/views/ folder.
	 *
	 * @param string $view   View file to display (Subview)
	 * @param bool   $return Return a rendered output by default
	 *
	 * @return mixed
	 */
	public function load( $view = '', $return = FALSE )
	{
		// If no default templates defined, get one from the config
		if( empty($this->template_default) ){
			$this->template_default = $this->CI->config->item('tpl_default');
		}

		// If view isn't provided then use the view based on class and method names
		if( $view == '' ){
			$view = $this->CI->router->class . '/' . $this->CI->router->method;
		}

		return $this->render($this->template_default, $view, $return);
	}
}
