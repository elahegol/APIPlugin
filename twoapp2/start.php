<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

elgg_register_event_handler('init', 'system', 'twoapp2_init');
function twoapp2_init() 
{


	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "twoapp2/actions/twoapp2";
	elgg_register_action("twoapp2/usersettings/save", "$actionspath/usersettings/save.php");


elgg_register_library('twoapp2:show', elgg_get_plugins_path() . 'twoapp2/lib/twoapp2.php');
elgg_load_library('twoapp2:show');








	}

