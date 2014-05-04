<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * @var	string		$tpl_pagetitle		Page title mixed up with Sitename from config file
 * @var	string		$tpl_pagename		Page name
 * @var	array		  $tpl_scripts_head	Header javascript files
 * @var	array		  $tpl_scripts_foot	Footer javascript files designated to place before </body> tag
 * @var	array		  $tpl_stylesheets	Stylesheet files with view type param
 * @var	string		$tpl_view			Main content of the subview where it should be loaded to
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php echo $this->config->item('charset'); ?>">
	<meta http-equiv="content-type" content="text/html; charset=<?php echo $this->config->item('charset'); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo base_url('favicon.ico'); ?>" type="image/x-icon">

	<title><?php echo $tpl_pagetitle; ?></title>

	<?php foreach( $tpl_stylesheets as $src => $type ): ?>
		<link href="<?php echo base_url('assets/css/' . $src); ?>" media="<?php echo $type;?>" rel="stylesheet">
	<?php endforeach; ?>

	<?php foreach( $tpl_scripts_head as $item ): ?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/' . $item); ?>"></script>
	<?php endforeach; ?>
</head>
<body>

	<h1>
		<?php echo $tpl_pagename;?>
	</h1>


	<main>
		<?php echo $tpl_view;?>
	</main>



	<?php foreach( $tpl_scripts_foot as $item ): ?>
		<script type="text/javascript" src="<?php echo base_url('assets/js/' . $item); ?>"></script>
	<?php endforeach; ?>

</body>
</html>
