<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
function app2_get_blog($context,  $limit = 10, $offset = 0,$group_guid, $username) {	
if(!$username) {
		$user = elgg_get_logged_in_user_entity();
	} else {
		$user = get_user_by_username($username);
		if (!$user) {
			throw new InvalidParameterException('registration:usernamenotvalid');
		}
	}
		
		if($context == "all"){
		$params = array(
			'types' => 'object',
			'subtypes' => 'blog',
			'limit' => $limit,
			'full_view' => FALSE,
		);
		
echo elgg_list_entities($params);
		}
		if($context == "mine" || $context ==  "user"){
		$params = array(
			'types' => 'object',
			'subtypes' => 'blog',
			'owner_guid' => $user->guid,
			'limit' => $limit,
			'full_view' => FALSE,
		);
		echo elgg_list_entities($params);
		}
}

function app2_blog_save($title, $text, $excerpt, $tags , $access, $container_guid) {
	$user = elgg_get_logged_in_user_entity();
	if (!$user) {
		throw new InvalidParameterException('registration:usernamenotvalid');
	}
	
	$obj = new ElggObject();
	$obj->subtype = "blog";
	$obj->owner_guid = $user->guid;
	$obj->container_guid = $container_guid;
	$obj->access_id = strip_tags($access);
	$obj->method = "api";
	$obj->description = strip_tags($text);
	$obj->title = elgg_substr(strip_tags($title), 0, 140);
	$obj->status = 'published';
	$obj->comments_on = 'On';
	$obj->excerpt = strip_tags($excerpt);
	$obj->tags = strip_tags($tags);
	$guid = $obj->save();
	elgg_create_river_item('river/object/blog/create',
	'create',
	$user->guid,
	$obj->guid
	);
if($guid)
{
	return true;
}
else
{

return false;
}
	} 
