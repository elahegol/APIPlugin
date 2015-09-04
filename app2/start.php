<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

elgg_register_event_handler('init', 'system', 'app2_init');
function app2_init() 
{




	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "app2/actions/app2";
	elgg_register_action("app2/usersettings/save", "$actionspath/usersettings/save.php");


elgg_register_library('app2:show', elgg_get_plugins_path() . 'app2/lib/app.php');
elgg_load_library('app2:show');





	

}

