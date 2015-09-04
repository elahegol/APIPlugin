<?php
/**
* User settings edit code
* 
*/


ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

admin_gatekeeper();
$guid = elgg_get_page_owner_guid();

$settings = elgg_get_all_plugin_user_settings($guid, 'adduserAPI');


$name='adduser';

$user = elgg_get_logged_in_user_entity();
$username=$user->username ;
$adduser_plugin = elgg_get_plugin_from_id('adduserAPI');
//$adduser_token = $adduser_plugin->getUserSetting('token', $user->guid );
//$adduser_secret = $adduser_plugin->getUserSetting('secret', $user->guid );

//
$r=elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>$name));

//if(!elgg_get_entities(array('types' => 'object',
	//'subtypes' => 'appname', 'title'=>$name)))
	if(!get_subtype_id('object','app'.$name))
	{
		
	register_error( elgg_echo($name." application not register!!"));
forward(REFERER);

}
else
{



		if( elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>'app'.$name,'owner_guid'=> elgg_get_logged_in_user_guid())))

	{
$user_plugin = elgg_get_plugin_from_id('userAPI');

$user_public = $user_plugin->getUserSetting($name.'public', $user->guid );
$user_private = $user_plugin->getUserSetting($name.'private', $user->guid );
	}




$entities= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'token','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities)
	{
	foreach($entities as $entity)
	{
		$adduser_token=$entity->title;
	
	echo "<br/>";
	}
	}
	
	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
		foreach($entities2 as $entity2)
		{
	$adduser_secret=$entity2->title;
	
	
	
	}}
	$secret=$adduser_secret;
	$token=$adduser_token;
if(!$secret&& !$token)
{

echo "</br> you must generate token and secret for use ".$name." application</br>";
}




echo "</br></br></br>";

}




?>

<div >
<input type="text" name='app' id='app' hidden value="<?php echo $name;?>" />

</div>

<div align="center">
<label><h2>Authorize for add new user</h2></label>


<div id="show_keys" align="left" style="color:green;display:none;">

<h2> <br />Enter your public and private keys<br/></h2>







<h3>Public Key:</h3> <input type="text" id="mypublic" name="public" value="<?php echo $user_public;?>" >
<h3>Private Key:</h3> <input type="text" id="myprivate" name="private" value="<?php echo $user_private;?>"  >

</div>

<script type="text/javascript">
var user_public="<?php echo $user_public;?>";
var user_private="<?php echo $user_private;?>";

if  ( user_public && user_private)//
{
document.getElementById('show_keys').style.display='inline';
var x=1;
}
else
{
	var x=0;
}

</script>


<div align="left">
<form >
<h2> <br />Enter your access token and secret<br/></h2>

<h3>Secret key:</h3> <input type="text" id="usersecret2" name="usecret2" value="<?php echo $adduser_secret;?>"  >
<h3>Token key:</h3> <input type="text" id="usertoken2" name="utoken2" value="<?php echo $adduser_token;?>"  >





<input type="Button" class="elgg_button" value="Authorize" width="610px" onclick = "enter()" >


<form/>

<div align="center" >

<div id="verifyok" style="color:green;display:none;">Code is Correct</div>
<div id="verifyerror" style="color:red;display:none;">Wrong code or server error</div>

<!--<form method="GET" action="" >-->


<div id="show" align="left" style="color:green;display:none;">
<br/>
<label><h2 align="center" style="color:#3CF">enter user information</h2></label>
<h3>name:</h3> <input type="text" id="name" name="name" value=""  / >
<h3>email:</h3> <input type="email" id="email" name="email" value="" / >
<h3>username:</h3> <input type="text" id="username" name="username" value="" / >
<h3>password:</h3> <input type="password" id="password" name="password" value="" / >
<!--<input type="button"  value="add user" width="610px" onclick="save()"  >-->



<h2 align="center"style="color:#3CF">for add new user to DB<br /> click on save button(end of page)
</h2>
 </div>

<!-- <input type="text" id="message" name="message" value="" readonly >-->


<br/>
<h2>--------------------------------------------------------------------------<h2/>
<h2>--------------------------------------------------------------------------<h2/>
<h2>--------------------------------------------------------------------------<h2/>


<br />
<div align="center">
<label><h3>Generate access token and access secret</h3></label>
<br />
<div align="left">
<h4>Generate access token and secret for adduser Application.Allow?</h4>
<br />



<div align="left">




<form>

<h5>Your secret:</h5><input type="text" id="mysecret" name="secret" value="" readonly>

<h5>Your token:</h5><input type="text" id="mytoken" name="token" value="" readonly>

<input type="Button" class="elgg_button" value="Generate access token and secret" width="610px" onclick = "newSecret()" >


</form>
<br/>
<label style="color:#3FF">For save in DB,click save button</label>
<script type="text/javascript">


function save()
{
	<?php
	
	
	if(!isset ($_GET['email']))
	{
		$u=$_GET['email'];
	
	}
	else
	{
		$t=0;
	}
?>
	//alert("ok");
	
	document.getElementById('message').value="<?php echo $t; ?>";
}
function enter()
{

//if(document.getElementById('show_keys').style.display='inline')
if(x==1)
{
//alert("ok");

var user_public="<?php echo $user_public;?>";
var user_private="<?php echo $user_private;?>";
var friend_token="<?php echo $adduser_token;?>";
var friend_secret="<?php echo $adduser_secret;?>";
//alert(friend_token);
//alert(user_private);
//var secret= document.getElementById('usersecret').value;
//alert(secret);
var secret2=document.getElementById('usersecret2').value;

var token2=document.getElementById('usertoken2').value;

//var token= document.getElementById('usertoken').value;
//alert(secret);
var public= document.getElementById('mypublic').value;
var private= document.getElementById('myprivate').value;
token2=$.trim(token2);
secret2=$.trim(secret2);
public=$.trim(public);
private=$.trim(private);
//var public2= document.getElementById('mypublic2').value;
//var private2= document.getElementById('myprivate2').value;


if( public == "" || private == "" || secret2=="" || token2=="" )
    {
       
 alert("Keys is empty!!!");
    }

else
{
if( user_public == "" || user_private == ""  || friend_token== "" || friend_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(  (public == user_public) &&(private == user_private) && (secret2 == friend_secret) && (token2 == friend_token))
{

//alert("authorized");
document.getElementById('show').style.display='inline';


  
}



else
{
alert("enter Right Keys!");
}
}
}


}
//if(document.getElementById('show_keys').style.display='none')
else
{
	//for client



var friend_token="<?php echo $adduser_token;?>";
var friend_secret="<?php echo $adduser_secret;?>";
//alert(friend_token);
//alert(user_private);
//var secret= document.getElementById('usersecret').value;
//alert(secret);
var secret2=document.getElementById('usersecret2').value;
var token2=document.getElementById('usertoken2').value;
//var token= document.getElementById('usertoken').value;
//alert(secret);



token2=$.trim(token2);
secret2=$.trim(secret2);

//var public2= document.getElementById('mypublic2').value;
//var private2= document.getElementById('myprivate2').value;


if( token2=="" || secret2=="" )
    {
       
 alert("Keys is empty!!!");
    }

else
{
if(  friend_token== "" || friend_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(   (secret2 == friend_secret) && (token2 == friend_token))
{

//alert("authorized");
document.getElementById('show').style.display='inline';


  
}



else
{
alert("enter Right Keys!");
}
}
}


}
}



function newSecret()
{
    var xstr = "";
    qrurl = "";
    
    window.XMLHttpRequest
    {
        xmlhttp = new XMLHttpRequest();
    }
    
    //xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() 
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) 
        {

            //alert(xmlhttp.responseText);
          xstr=xmlhttp.responseText;
		  if(xstr != "")
		  {
             var res = xstr.split(";");
             document.getElementById('mytoken').value = res[1];
             document.getElementById('mysecret').value = res[0];
		  }
		  else
          {
             alert("You don't have a secret!");
          }
        }
    }
	var currentuser = "<?php echo $name; ?>";
    xmlhttp.open("GET","http://localhost/elgg-1.11.0/mod/adduserAPI/views/default/adduserAPI/coder.php",true);
    xmlhttp.send();
}
 

</script>
