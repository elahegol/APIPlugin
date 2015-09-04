<?php
$public=get_input('public');
$private=get_input('private');
$name=get_input('appname');
$name=str_replace(' ','',$name);
$plugin_id = get_input('plugin_id');
$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$plugin = elgg_get_plugin_from_id($plugin_id);
$user = get_entity($user_guid);
$user = elgg_get_logged_in_user_entity();
$username=$user->username ;
$user_guid = elgg_get_logged_in_user_guid();
if (!($plugin instanceof ElggPlugin)) {
	register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_id)));
	forward(REFERER);
}
	
if (!($user instanceof ElggUser)) {
	register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_id)));
	forward(REFERER);
}

$plugin_name = $plugin->getManifest()->getName();

// make sure we're admin or the user
if (!$user->canEdit()) {
	register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
	forward(REFERER);
}
$user_plugin = elgg_get_plugin_from_id('userAPI');
//save
if($name!="")
{
//if(! elgg_get_entities(array('types' => 'object',
	//'subtypes' => 'appname', 'title'=>$name)))
	if(!get_subtype_id('object','app'.$name))

	
{
	
		if($public=="" && $private=="")
{
	register_error(elgg_echo("keys are empty"));
forward(REFERER);
}
else
{
	add_subtype('object','app'.$name);
	$entity=new ElggObject();
$entity -> subtype ='appname';
$entity -> title ='app'.$name;
//$entity -> description =$username;
//
if($entity ->save())
{
if (isset($public)) {
	$result = $plugin->setUserSetting($name.'public', $public, $user->guid);

	if (!$result) {

		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
		forward(REFERER);

	}
} else {
	$plugin->unsetUserSetting($name.'public', $user->guid);
}
if (isset($private)) {
	$result = $plugin->setUserSetting($name.'private', $private, $user->guid);

	if (!$result) {
		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
		forward(REFERER);
	}
} else {
	$plugin->unsetUserSetting($name.'private', $user->guid);
}
system_message(elgg_echo($name." : application register"));
forward(REFERER);
}
}	
}
else
{
	if( elgg_get_entities(array('types' => 'object','subtypes' => 'appname' , 'title'=>'app'.$name,'owner_guid'=> elgg_get_logged_in_user_guid())))
	{
		if($public=="" && $private=="")
{
	$options=array('types' => 'object',
	'subtypes' => 'appname' , 'title'=>'app'.$name,'owner_guid'=> elgg_get_logged_in_user_guid());
	//delete_metadata($options);
	$entities=elgg_get_entities($options);
	foreach($entities as $entity)
	{
	$entity->delete();
	}
	if(!elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token')) && !elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret'))) 
	{
	$plugin->unsetUserSetting($name.'public', $user->guid);
	$plugin->unsetUserSetting($name.'private', $user->guid);
	remove_subtype('object','app'.$name);
	system_message(elgg_echo($name." : application is deleted"));
forward(REFERER);
	}
	else
	{
		$entities=elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token'));
	foreach($entities as $entity)
	{
	$entity->delete();
	}
	$entities2=elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret'));
	foreach($entities2 as $entity2)
	{
	$entity2->delete();
	}
remove_subtype('object',$name.'secret');
remove_subtype('object',$name.'token');
$plugin->unsetUserSetting($name.'public', $user->guid);
	$plugin->unsetUserSetting($name.'private', $user->guid);
	remove_subtype('object','app'.$name);

	system_message(elgg_echo($name." : application is deleted"));
forward(REFERER);

	}
}
else
{
		if (isset($public)) {
	$result = $plugin->setUserSetting($name.'public', $public, $user->guid);

	if (!$result) {

		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
		forward(REFERER);

	}
} else {
	$plugin->unsetUserSetting($name.'public', $user->guid);
}
if (isset($private)) {
	$result = $plugin->setUserSetting($name.'private', $private, $user->guid);

	if (!$result) {
		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
		forward(REFERER);
	}
} else {
	$plugin->unsetUserSetting($name.'private', $user->guid);
}
system_message(elgg_echo($name." : application is updated"));
forward(REFERER);

}
	}	
	else
	{
		if($public=="" && $private=="")
{
	register_error(elgg_echo("keys are empty"));
forward(REFERER);
}
else
{
		
	register_error(elgg_echo($name. ' application  exist'));
	forward(REFERER);
}
	}
}	
}
else
{
	register_error(elgg_echo( 'enter application  name'));
	forward(REFERER);
}
	
