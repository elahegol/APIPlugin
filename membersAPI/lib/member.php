<?php


ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

if(! function_exists('show_members_php'))
{
function show_members_php($context,  $limit = 30, $offset = 0,  $username) {	
	if(!$username) {
		$user = elgg_get_logged_in_user_entity();
	} else {
		$user = get_user_by_username($username);
		if (!$user) {
			throw new InvalidParameterException('registration:usernamenotvalid');
		}
	}

if($context == "newest"){
		$params = array(
			'types' => 'user',
			'limit' => $limit,
			'full_view' => FALSE,

		);
$latest_member = elgg_get_entities($params);
echo elgg_list_entities($params);

}
		

		



if($context == "popular")
{
	$params = array(
			'types' => 'user',
			'relationship' => 'friend',
		'inverse_relationship' => false,
		);
		echo elgg_list_entities_from_relationship_count($params);	


}
		
	if($context == "online" ){
		echo get_online_users();
		
		}	
		

	
	
	
}
}




if(! function_exists('show_members_json'))
{
function show_members_json($context,  $limit = 30, $offset = 0,  $username) {	
if(!$username) {
		$user = elgg_get_logged_in_user_entity();
	} else {
		$user = get_user_by_username($username);
		if (!$user) {
			throw new InvalidParameterException('registration:usernamenotvalid');
		}
	}
		
		if($context == "newest"){
		$params = array(
			'types' => 'user',
			'limit' => $limit,
			'full_view' => FALSE,
		);
		
		
		
		$latest_member = elgg_get_entities($params);
			
	
	//return $return;
		}
		if($context == "online" ){
		$latest_member= get_online_users();
		
	
		}
		if($context == "popular"){
			
			$params = array(
			'types' => 'user',
			'relationship' => 'friend',
		'inverse_relationship' => false,
		);
		$latest_member = elgg_list_entities_from_relationship_count($params);
		}
		
		if($latest_member) {
		foreach($latest_member as $single ) {
			$member['guid'] = $single->guid;
			
			
			
			$member['name'] = $single->name;
			
			//$member['avatar_url'] = get_entity_icon_url($single,'small');
			
		
			$return[] = $member;
		}
	}
	
	
	//return $return;
	return json_encode($return,true);

	
	
}
}
