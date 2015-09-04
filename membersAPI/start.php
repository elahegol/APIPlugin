<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

elgg_register_event_handler('init', 'system', 'membersAPI_init');
function membersAPI_init() 
{
global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "membersAPI/actions/membersAPI";
	elgg_register_action("membersAPI/usersettings/save", "$actionspath/usersettings/save.php");


	elgg_register_library('member:show', elgg_get_plugins_path() . 'membersAPI/lib/member.php');
elgg_load_library('member:show');



	}


