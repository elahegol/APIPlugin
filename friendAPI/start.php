<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

elgg_register_event_handler('init', 'system', 'friendAPI_init');
function friendAPI_init() 
{



	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "friendAPI/actions/friendAPI";
	elgg_register_action("friendAPI/usersettings/save", "$actionspath/usersettings/save.php");


elgg_register_library('friend:show', elgg_get_plugins_path() . 'friendAPI/lib/friend.php');
elgg_load_library('friend:show');






}

