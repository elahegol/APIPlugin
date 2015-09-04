<?php

elgg_register_event_handler('init', 'system', 'userAPI_init');
function userAPI_init() 
{
	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "userAPI/actions/userAPI";
	elgg_register_action("userAPI/usersettings/save", "$actionspath/usersettings/save.php");
	

	  





	}


