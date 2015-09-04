<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

elgg_register_event_handler('init', 'system', 'adduserAPI_init');
function adduserAPI_init() 
{


	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "adduserAPI/actions/adduserAPI";
	elgg_register_action("adduserAPI/usersettings/save", "$actionspath/usersettings/save.php");


elgg_register_library('user:add', elgg_get_plugins_path() . 'adduserAPI/lib/adduser.php');
elgg_load_library('user:add');




	
	}



