<?php
/**
* User settings edit code
* 
*/


ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

global $CONFIG;
	$path = $CONFIG->site->url ;
	//$path=elgg_get_site_url ();
$guid = elgg_get_page_owner_guid();

$settings = elgg_get_all_plugin_user_settings($guid, 'app2');


$name='app2';


//$friend_token = $friend_plugin->getUserSetting($name.'token', $user->guid );

//$friend_secret = $friend_plugin->getUserSetting($name.'secret', $user->guid );

//if no show friend API keys
/*if(!get_subtype_id('object',$name))
{
	register_error( elgg_echo("app2 application not register!!"));
forward(REFERER);

}
*/
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
	{$friend_token=$entity->title;

	echo "<br/>";
	}
	}
	
	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
		foreach($entities2 as $entity2)
		{
	$friend_secret=$entity2->title;
	//echo $friend_secret;
	
	
	}}
	$f=$friend_secret;
	//foreach($entities2 as $entity2)
	//{$f=$entity2->description;
	//}

$token=$friend_token;
$secret=$friend_secret;
$user = elgg_get_logged_in_user_entity();
$username=$user->username ;
$friend_plugin = elgg_get_plugin_from_id('app2');
if(!$secret && !$token)
{
	echo "</br> You must generate token and secret for use '".$name."' application</br>";
}




echo "</br></br></br>";
}




?>

<div >
<input type="text" id="app" name="app" hidden value="<?php echo $name; ?>" >

</div>
<div align="center">

<div align="center">
<label><h2>Authorize for show blogs and add blogs</h2></label>


<div id="show_keys" align="left" style="color:green;display:none;">

<h2> <br />Enter your public and private keys<br/></h2>







<h3>Public Key:</h3> <input type="text" id="mypublic"  name="public" value="<?php echo $user_public;?>" >
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

<h3>Secret key:</h3> <input type="text" id="usersecret2" name="usecret2" value="<?php echo $f; ?>"  >
<h3>Token key:</h3> <input type="text" id="usertoken2" name="utoken2" value="<?php echo $friend_token;?>"  >






<input type="Button" class="elgg_button" value="Authorize" width="610px" onclick = "enter()" >


<form/>


<div align="center" >

<div id="buttons" style="color:green;display:none;">
<input type="Button" class="elgg_button" value="show blogs" width="610px" onclick = "enter2()" >

<input type="Button" class="elgg_button" value="Add blogs" width="610px" onclick = "enter3()" >

</div>


<div id="show" style="color:green;display:none;"><?php
echo elgg_echo("blog:title:user_blogs", array($user->username));
echo "</br>";

print_r (array_values(app2_get_blog('user',  $limit = 10, $offset = 0,'',$user->username))) ;

echo "</br>";
echo "</br>";
echo elgg_echo("blog:title:all_blogs", array($user->username));
echo "</br>";


print_r (array_values(app2_get_blog('all',  $limit = 10, $offset = 0,'',$user->username))) ;

echo "</br>";
echo "</br>";



 ?></div>




<div id="show2" align="left" style="color:green;display:none;">
<br/>
<label><h2 align="center" style="color:#3CF">enter information</h2></label>
<h3> blog title:</h3> <input type="text" id="title" name="title" value="" / >
<h3>text:</h3> <input type="text" id="text" name="text" value="" / >
<h3> excerpt:</h3> <input type="text" id="excerpt" name="excerpt" value="" / >
<h3>tags:</h3> <input type="text" id="tags" name="tags" value="" / >





<h2 align="center"style="color:#3CF">for add new blog to DB<br /> click on save button(end of page)
</h2>
 </div>








<br/>
<h2>--------------------------------------------------------------------------<h2/>
<h2>--------------------------------------------------------------------------<h2/>
<h2>--------------------------------------------------------------------------<h2/>


<br />
<div align="center">
<label><h3>Generate access token and access secret</h3></label>
<br />
<div align="left">
<h4>Generate access token and secret for app2 Application.Allow?</h4>
<br />



<div align="left">




<form>

<h5>Your secret:</h5><input type="text" id="mysecret" name="secret" value="" readonly>

<h5>Your token:</h5><input type="text" id="mytoken" name="token" value="" readonly>

<input type="Button" class="elgg_button" value="generate access token and secret" width="610px" onclick = "newSecret()" >


</form>
<br/>
<label style="color:#3FF">For save in DB,click save button</label>
<script type="text/javascript">



function enter()
{

//if(document.getElementById('show_keys').style.display='inline')
if(x==1)
{
//alert("ok");

var user_public="<?php echo $user_public;?>";
var user_private="<?php echo $user_private;?>";
var friend_token="<?php echo $friend_token;?>";
var friend_secret="<?php echo $friend_secret;?>";
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

//var public2= document.getElementById('mypublic2').value;
//var private2= document.getElementById('myprivate2').value;

token2=$.trim(token2);
secret2=$.trim(secret2);
public=$.trim(public);
private=$.trim(private);

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
document.getElementById('buttons').style.display='inline';


  
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


var friend_token="<?php echo $friend_token;?>";
var friend_secret="<?php echo $friend_secret;?>";
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
document.getElementById('buttons').style.display='inline';


  
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
	
	
	var path='<?php echo $path;?>';
    xmlhttp.open("GET",path+"mod/app2/views/default/app2/coder.php",true);
    xmlhttp.send();
}
 

function enter2()
{
	document.getElementById('show2').style.display='none';

	document.getElementById('show').style.display='inline';

}
function enter3()
{
	document.getElementById('show').style.display='none';

	document.getElementById('show2').style.display='inline';

}

</script>
