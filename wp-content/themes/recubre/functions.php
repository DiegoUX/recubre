<?php
/**
 * @package WordPress
 * @subpackage TechGo
 * @since WD_Responsive
 **/
$_template_path = get_template_directory();
require_once $_template_path."/theme/theme.php";
$theme = new Theme(array(
	'theme_name'	=>	"TechGo",
	'theme_slug'	=>	'techgo'
));
$theme->init();
?>