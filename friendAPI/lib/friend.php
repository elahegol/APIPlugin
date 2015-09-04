<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


function user_get_friends($username, $limit = 10, $offset = 0) {

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

	if($username)
{
$user=get_user_by_username($username);
}
else
{
		$user = elgg_get_logged_in_user_entity();
}
	
	if (!$user) {
		throw new InvalidParameterException(elgg_echo('registration:usernamenotvalid'));
	}
	
	$options=array('limit' => $limit,
				'offset' => $offset,);
	$friends = $user->getfriends($options,10,0);
	$friends=get_list_entities_from_relationship($friends);
//return get_user_friends($user->guid, '' , $limit, $offset);
	if($friends){
	foreach($friends as $single) {
		$friend['guid'] = $single->guid;
		$friend['username'] = $single->username;
		$friend['name'] = $single->name;
		$friend['avatar_url'] = get_entity_icon_url($single,'small');
		$return[] = $friend;

	}
	} 
	return $return;

} 


if(! function_exists('show_friends_json'))
{


				
				
				function show_friends_json($username, $limit = 10, $offset = 0)
				{
					if($username)
{
$user=get_user_by_username($username);
}
else
{
		$user = elgg_get_logged_in_user_entity();
}
	
	if (!$user) {
		throw new InvalidParameterException(elgg_echo('registration:usernamenotvalid'));
	}
					$options = array(
	'relationship' => 'friend',
	'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'type' => 'user',
	
	'full_view' => false,
	'no_results' => elgg_echo('friends:none'),
);



$friends = $user->getFriends($options,10,0);
	

	if($friends){
	foreach($friends as $single) {
		$friend['guid'] = $single->guid;
		$friend['username'] = $single->username;
		$friend['name'] = $single->name;
		$friend['avatar_url'] = elgg_view_entity_icon($single,'small');
		$return[] = $friend;


	}}
	
	
				   echo json_encode($return,true).'<br/>';

	
				}
	
}
	
	
	
	if(! function_exists('show_friends_php'))
{
	
	function show_friends_php($username,$limit=10,$offset=0)
	{
if($username)
{
$user=get_user_by_username($username);
}
else
{
		$user = elgg_get_logged_in_user_entity();
}
	
	if (!$user) {
		throw new InvalidParameterException(elgg_echo('registration:usernamenotvalid'));
	}
					$options = array(
	'relationship' => 'friend',
	'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'type' => 'user',
	
	'full_view' => false,
	'no_results' => elgg_echo('friends:none'),
);

echo elgg_list_entities_from_relationship($options);
	}
				
}
