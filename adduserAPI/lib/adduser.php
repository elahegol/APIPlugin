<?php
if(! function_exists('add_user_json'))
{
function add_user_json($name, $email, $username, $password) {
	$user = get_user_by_username($username);
$mailtest=get_user_by_email($email);
	if (!$mailtest &&  !$user)
 {

if(register_user($username, $password, $name, $email))
{
	
$msg['adduser']=true;
$msg['message']=$username.':saved';
return json_encode($msg,true);
//return $msg;
}
}


else
{		
$msg['adduser']=false;
$msg['message']='user or email exist';
return json_encode($msg,true);

//return $msg;
}

	}


}
if(! function_exists('add_user_php'))
{
function add_user_php($name, $email, $username, $password) {
	$user = get_user_by_username($username);
$mailtest=get_user_by_email($email);
	if (!$mailtest &&  !$user)
 {

if(register_user($username, $password, $name, $email))
{
return true;
}
}


else
{		
return false;;
}

	}


}
