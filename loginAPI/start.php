<?php

elgg_register_event_handler('init', 'system', 'loginAPI_init');
function loginAPI_init() 
{
	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "loginAPI/actions/loginAPI";
	elgg_register_action("loginAPI/usersettings/save", "$actionspath/usersettings/save.php");
	elgg_register_action('login', dirname(__FILE__) . '/actions/login.php', 'public');
	elgg_extend_view('forms/login', 'loginAPI/login');
}
