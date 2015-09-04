<?php
$secret=get_input('secret');
$token=get_input('token');
$plugin_id = get_input('plugin_id');
$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$plugin = elgg_get_plugin_from_id($plugin_id);
$user = get_entity($user_guid);


$name=get_input('app');




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
//save

//
//if (isset($secret)) {
//	$result = $plugin->setUserSetting($name.'secret', $secret, $user->guid);
//
//	if (!$result) {
//
//		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_namet)));
//		forward(REFERER);
//
//	}
//} else {
//	$plugin->unsetUserSetting($name.'secret', $user->guid);
//}
//if (isset($token)) {
//	$result = $plugin->setUserSetting($name.'token', $token, $user->guid);
//
//	if (!$result) {
//		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
//		forward(REFERER);
//	}
//} else {
//	$plugin->unsetUserSetting($name.'token', $user->guid);
//}
//
//system_message(elgg_echo('plugins:usersettings:save:ok',array($plugin_name)));
//forward(REFERER);


if ($token!=""&& $secret!="")
{ 
if(!elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token','owner_guid'=> elgg_get_logged_in_user_guid())) && !elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret','owner_guid'=> elgg_get_logged_in_user_guid()))) 
	{
	$entity=new ElggObject();
//$entity -> subtype ='appname';
$entity -> subtype =$name.'token';

//$entity -> title =$name.'token';
$entity -> title=$token;
$entity->save();

$entity2=new ElggObject();
//$entity -> subtype ='appname';
$entity2 -> subtype =$name.'secret';
$entity2 -> title =$secret;
////$entity -> title ='apiname';

$entity2->save();
//
if($entity ->save()&& $entity2->save())
{
system_message(elgg_echo($name.":new keys saved"));
forward(REFERER);

}
	}
	
else
{
	$entities= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities)
	{
	foreach($entities as $entity)
	{
		$entity->delete();
		}
	
	}
	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
		foreach($entities2 as $entity2)
	{
			$entity2->delete();
	}
	}
	
	
	
	
	$entity=new ElggObject();
//$entity -> subtype ='appname';
$entity -> subtype =$name.'token';

//$entity -> title =$name.'token';
$entity -> title=$token;
$entity->save();

$entity2=new ElggObject();
//$entity -> subtype ='appname';
$entity2 -> subtype =$name.'secret';
$entity2 -> title =$secret;
////$entity -> title ='apiname';

$entity2->save();
//
if($entity ->save()&& $entity2->save())
{
system_message(elgg_echo($name.":keys updated"));
forward(REFERER);

}
}}
else
{
	if(!elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret' ,'owner_guid'=> elgg_get_logged_in_user_guid())) && !elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token','owner_guid'=> elgg_get_logged_in_user_guid()))) 
	{
		register_error(elgg_echo($name.":keys is empty"));
forward(REFERER);

	}
	else
	{
	$entities= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities)
	{
	foreach($entities as $entity)
	{
		$entity->delete();
	}
	
	}
	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret', 'title'=>$name.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
	foreach($entities2 as $entity2)
	{
		$entity2->delete();
	}
	}
	
	
	
	system_message(elgg_echo($name.":keys deleted"));
forward(REFERER);

	
}}
