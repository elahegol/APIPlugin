<?php
/**
 * Elgg login action
 *
 * @subpackage User.Authentication
 */
// set forward url
if (!empty($_SESSION['last_forward_from'])) {
	$forward_url = $_SESSION['last_forward_from'];
} elseif (get_input('returntoreferer')) {
	$forward_url = REFERER;
} else {
	// forward to main index page
	$forward_url = '';
}
$username = get_input('username');
$password = get_input('password', null, false);
$application=get_input('app');
$application=str_replace(' ','',$application);
$persistent = (bool) get_input("persistent");

$result = false;
if (empty($username) || empty($password)) {
	register_error(elgg_echo('login:empty'));
	forward();
}
// check if logging in with email address
if (strpos($username, '@') !== false && ($users = get_user_by_email($username))) {
	$username = $users[0]->username;
}
$result = elgg_authenticate($username, $password);
if ($result !== true) {
	register_error($result);
	forward(REFERER);
}
//get users guid
$user = get_user_by_username($username);
$userGuid = $user->getGUID();
if($application=="")
{
$f=true;
	$user = get_user_by_username($username);
   try
   {
	login($user, $persistent);
	// re-register at least the core language file for users with language other than site default
	register_translations(dirname(dirname(__FILE__)) . "/languages/");
   } 
   catch (LoginException $e) 
   {
	register_error($e->getMessage());
	forward(REFERER);
   }
   
}
else
{
$f=false;
	if(get_subtype_id('object','app'.$application))
	{		
	$t=true;
	}			else
			{
				$t=false;
			}
$user = get_user_by_username($username);
   try
   {
	login($user, $persistent);
	// re-register at least the core language file for users with language other than site default
	register_translations(dirname(dirname(__FILE__)) . "/languages/");
   } 
   catch (LoginException $e) 
   {
	register_error($e->getMessage());
	forward(REFERER);
   }		}
if ($user->language) {
		$message = elgg_echo('loginok', array(), $user->language);
} else {	
		$message = elgg_echo('loginok');
	}
if (isset($_SESSION['last_forward_from'])) {
	unset($_SESSION['last_forward_from']);
}
if($f)
	{
		$msg['login']=$message;

	$msg= json_encode($msg,true).'<br/>';
		system_message($msg);
	}
	else
	{
if($t==true)
{
	if( elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>'app'.$application,'owner_guid'=> elgg_get_logged_in_user_guid())))
	{
$user_plugin = elgg_get_plugin_from_id('userAPI');
$user_public = $user_plugin->getUserSetting($application.'public', $user->guid );
$user_private = $user_plugin->getUserSetting($application.'private', $user->guid );
	}
	else
	{
		$user_public = '';
$user_private ='';
	}
	if($user_private && $user_public)
	{
		$user=true;	
	}
	else
	{
		$user=false;
	}	
	if(!elgg_get_entities(array('types' => 'object',
	'subtypes' => $application.'token','owner_guid'=> elgg_get_logged_in_user_guid())) && !elgg_get_entities(array('types' => 'object',
	'subtypes' => $application.'secret','owner_guid'=> elgg_get_logged_in_user_guid()))) 
	{
		
		
		$secret = md5(time().rand());
		$token = md5(md5(time() .rand()+ time()));
	$entity=new ElggObject();
$entity -> subtype =$application.'token';
$entity -> title=$token;
$entity->save();
$entity2=new ElggObject();
$entity2 -> subtype =$application.'secret';
$entity2 -> title =$secret;
$entity2->save();
}
else
{
	$entities= elgg_get_entities(array('types' => 'object',
	'subtypes' => $application.'token','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities)
	{
	foreach($entities as $entity)
	{
		//$entity->delete();
$token=$entity -> title ;
		}	}
	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $application.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
		foreach($entities2 as $entity2)
	{
			$secret=$entity2->title;
				}}	
	/*$entity=new ElggObject();
$entity -> subtype =$application.'token';
$entity -> title=$token;
$entity->save();
$entity2=new ElggObject();
$entity2 -> subtype =$application.'secret';
$entity2 -> title =$secret;
$entity2->save();*/
		$msg=array();
		$msg['message']=$app.':application exist';
		$msg['applicationname']=$application;
		if($user==true)
		{
						$msg['userregister']='yes';
									$msg['public']=$user_public;
			$msg['private']=$user_private;
		}
		else
		{
			$msg['userregister']='no';
		}
		$msg['token']=$token;
		$msg['secret']=$secret;
				$msg['login']=$message;
		$msg= json_encode($msg,true).'<br/>';
		echo $msg;
system_message($msg);
}}
else
{	$msg=array();
	$msg['message']=$application.':application not exist';
		$msg['login']=$message;
	$msg= json_encode($msg,true).'<br/>';
system_message($msg);


}}
forward($forward_url);
