<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
function blog_get_posts_json($context,  $limit = 30, $offset = 0,$group_guid, $username) {	
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
				'no_results' => elgg_echo('blog:noblogs'),

		);
		}
		if($context == "mine" || $context ==  "user"){
		$params = array(
			'types' => 'object',
			'subtypes' => 'blog',
			'owner_guid' => $user->guid,
			'limit' => $limit,
			'full_view' => FALSE,
				'no_results' => elgg_echo('blog:noblogs'),

		);
		}
		if($context == "group"){
		$params = array(
			'types' => 'object',
			'subtypes' => 'blog',
			'container_guid'=> $group_guid,
			'limit' => $limit,
			'full_view' => FALSE,
				'no_results' => elgg_echo('blog:noblogs'),

		);
		}
		$latest_blogs = elgg_get_entities($params);
		
		if($context == "friends"){
		//$latest_blogs= get_user_friends_objects($user->guid, 'blog', $limit, $offset);
		$options = array(
	//'relationship' => 'friend',
	'type' => 'object',
	'subtype' => 'blog',
	'full_view' => false,
	'no_results' => elgg_echo('blog:noblogs'),

);



//echo elgg_list_entities_from_relationship($options);
		$latest_blogs = $user->getFriendsObjects($options,  $limit, $offset);
		}
	
	
	if($latest_blogs) {
		foreach($latest_blogs as $single ) {
			$blog['guid'] = $single->guid;
			$blog['title'] = $single->title;
			$blog['excerpt'] = $single->excerpt;

			$owner = get_entity($single->owner_guid);
			$blog['owner']['guid'] = $owner->guid;
			$blog['owner']['name'] = $owner->name;
			$blog['owner']['username'] = $owner->username;
			//$blog['owner']['avatar_url'] = get_entity_icon_url($owner,'small');
			
			$blog['container_guid'] = $single->container_guid;
			$blog['access_id'] = $single->access_id;
			$blog['time_created'] = (int)$single->time_created;
			$blog['time_updated'] = (int)$single->time_updated;
			$blog['last_action'] = (int)$single->last_action;
			$return[] = $blog;
		}
	}

	//return $return;
	echo json_encode($return,true);
}
function blog_get_posts_php($context,  $limit = 30, $offset = 0,$group_guid, $username) {	
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
				'no_results' => elgg_echo('blog:noblogs'),

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
				'no_results' => elgg_echo('blog:noblogs'),

		);
		echo elgg_list_entities($params);
		}
}

function blog_save_php($title, $text, $excerpt, $tags , $access, $container_guid) {
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
	//$return['success'] = true;
	//$return['message'] = elgg_echo('blog:message:saved');
//$return="saved";
return true;
}
else
{
//$return="not saved!";
return false;
}
	//return $return;
	} 
	
	
	
	
	
	function blog_save_json($title, $text, $excerpt, $tags , $access, $container_guid) {
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
	
	$return['addblog'] = true;
	$return['message'] = elgg_echo('blog:message:saved');
	return json_encode($return,true);
//$return="saved";
//return true;
}
else
{
	$return['addblog'] = false;
	$return['message'] = elgg_echo('blog:error:cannot_save');
		return json_encode($return,true);

//$return="not saved!";
//return false;
}
	//return $return;
	} 
	
	
	
	
	
	
function blog_post_comment2($guid, $text){
	
	$entity = get_entity($guid);

	$user = elgg_get_logged_in_user_entity();

	$annotation = create_annotation($entity->guid,
								'generic_comment',
								$text,
								"",
								$user->guid,
								$entity->access_id);


	if($annotation){
		// notify if poster wasn't owner
		if ($entity->owner_guid != $user->guid) {

			notify_user($entity->owner_guid,
					$user->guid,
					elgg_echo('generic_comment:email:subject'),
					elgg_echo('generic_comment:email:body', array(
						$entity->title,
						$user->name,
						$text,
						//$entity->getURL(),
						$user->name,
						//$user->getURL()
				))
			);
		}
	
		//$return['success']['message'] = elgg_echo('generic_comment:posted');
$return="posted";
	} else {
		//$msg = elgg_echo('generic_comment:failure');
		//throw new InvalidParameterException($msg);
$return=" not posted";
	}
	return $return;
}
