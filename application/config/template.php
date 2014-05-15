<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
/*
| -------------------------------------------------------------------
|  Global Website Settings
| -------------------------------------------------------------------
*/
$config['tpl_sitename']			= 'Website name';

/*
|--------------------------------------------------------------------------
| Default Master Layout
|--------------------------------------------------------------------------
| 'template/default'	Produces app/views/template/default.php
*/
$config['tpl_default']			= 'template/default';

/*
|--------------------------------------------------------------------------
| Default CSS Files
|--------------------------------------------------------------------------
| Array key				Name of the stylesheet file
| Array value				Type of provided stylesheet: all / screen / print
*/
$config['tpl_default_css']		= array(
	'template.css'		=> 'all'
);

/*
|--------------------------------------------------------------------------
| Default javascript files
|--------------------------------------------------------------------------
| 'TRUE'				Inserts a javascript file into the HEAD element (<head>)
| 'FALSE'	(default)		Inserts a javascript file into the FOOTER section (just before </body>)
*/
$config['tpl_default_js']		= array(
	'appstrap.min.js'	=> TRUE,
	'template.js'		=> FALSE
);

/*
|--------------------------------------------------------------------------
| Title separator
|--------------------------------------------------------------------------
*/
$config['tpl_title_separator']		= ' | ';

/* End of file template.php */
/* Location: ./application/config/template.php */
