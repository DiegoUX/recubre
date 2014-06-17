<?php
	global $wd_custom_size,$wd_quantity;
	$_default_size = array(
							array(1200,450)
							,array(960,350)
							,array(190,122)
						);
	$wd_custom_size = get_option(THEME_SLUG.'custom_size','');
	if( strlen($wd_custom_size) > 0 ){
		$wd_custom_size = unserialize($wd_custom_size);
	}else{
		$wd_custom_size = $_default_size ;
	}					
?>