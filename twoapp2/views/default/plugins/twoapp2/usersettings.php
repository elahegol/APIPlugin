
<div align="center" >
<label  ><h2>'showblog' Application</h2>

</div>

<?php
/**
* User settings edit code
* 
*/


ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//echo "showblog application ";
$guid = elgg_get_page_owner_guid();
global $CONFIG;
	$path = $CONFIG->site->url ;
	//$path=elgg_get_site_url ();
$settings = elgg_get_all_plugin_user_settings($guid, 'twoapp2');
$name1='showblogs';



$user = elgg_get_logged_in_user_entity();
$username=$user->username ;
$two_plugin = elgg_get_plugin_from_id('twoapp2');

$r=elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>$name1));

		if(!get_subtype_id('object','app'.$name1))

	{
		
	echo ($name1." application not register!!");


}
else
{



	if( elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>'app'.$name1,'owner_guid'=> elgg_get_logged_in_user_guid())))

	{
		$user_plugin = elgg_get_plugin_from_id('userAPI');

$user_public = $user_plugin->getUserSetting($name1.'public', $user->guid );
$user_private = $user_plugin->getUserSetting($name1.'private', $user->guid );
	}

$entities= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name1.'token','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities)
	{
	foreach($entities as $entity)
	{
		$blog_token=$entity->title;
	
	echo "<br/>";
	}
	}

	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name1.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
		foreach($entities2 as $entity2)
		{
	$blog_secret=$entity2->title;
	
	
	
	}}


	








if($blog_secret =="" && $blog_token =="")
{
echo "</br> You must generate token and secret for use 'blog' application</br>";
}




echo "</br></br></br>";
}


?>


<div align="center">

<div align="center">

<label><h3>Authorize for show blogs</h3></label>

</div>
<div id="show_keys" align="left" style="color:green;display:none;">

<h5> <br />Enter your public and private keys<br/></h5>







<h5>Public Key:</h5> <input type="text" id="mypublic" name="public" value="<?php echo $user_public;?>" >
<h5>Private Key:</h5> <input type="text" id="myprivate" name="private" value="<?php echo $user_private;?>"  >

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
<h5> <br />Enter your access token and secret<br/></h5>

<h5>Secret key:</h5> <input type="text" id="usersecret2" name="usecret2" value="<?php echo $blog_secret;?>"  >
<h5>Token key:</h5> <input type="text" id="usertoken2" name="utoken2" value="<?php echo $blog_token;?>"  >





<input type="Button" class="elgg_button" value="Authorize" width="610px" onclick = "enter()" >


<form/>

<div align="center" >

<div id="verifyok" style="color:green;display:none;">Code is Correct</div>
<div id="verifyerror" style="color:red;display:none;">Wrong code or server error</div>
<div id="show" align ="center"style="color:green;display:none;"><?php
echo "show blogs (php)";
echo "</br>";

echo elgg_echo("blog:title:user_blogs", array($user->username));
echo "</br>";

echo blog_get_posts_php('user',  $limit = 30, $offset = 0,'',$user->username) ;

echo "</br>";
echo "</br>";
echo elgg_echo("blog:title:all_blogs", array($user->username));
echo "</br>";


echo blog_get_posts_php('all',  $limit = 30, $offset = 0,'',$user->username) ;

echo "</br>";
echo "</br>";

echo "show blogs (json)";
echo "</br>";

echo elgg_echo("blog:title:user_blogs", array($user->username));
echo "</br>";

echo blog_get_posts_json('user',  $limit = 30, $offset = 0,'',$user->username) ;

echo "</br>";
echo "</br>";
echo elgg_echo("blog:title:all_blogs", array($user->username));
echo "</br>";
echo blog_get_posts_json('all',  $limit = 30, $offset = 0,'',$user->username) ;

echo "</br>";
echo "</br>";

echo elgg_echo("'blog:title:friends'", array($user->username));
echo "</br>";

echo blog_get_posts_json('friends',  $limit = 30, $offset = 0,'',$user->username) ;



 ?></div>






</div>
<br/>
<h2>--------------------------------------------------------------------------<h2/>
<h2>--------------------------------------------------------------------------<h2/>
<h2>--------------------------------------------------------------------------<h2/>
</h2>
</div>



<div align="center">
<label ><h2>'addblog' Application</h2></label>
</div>
<?php
/**
* User settings edit code
* 
*/


ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

//echo "showgroup application ";
$guid = elgg_get_page_owner_guid();

$settings = elgg_get_all_plugin_user_settings($guid, 'twoapp2');

$name2='addblog';


$user = elgg_get_logged_in_user_entity();
$username=$user->username ;
$two_plugin = elgg_get_plugin_from_id('twoapp2');
//$g_token = $two_plugin->getUserSetting($name2.'token', $user->guid );
//$g_secret = $two_plugin->getUserSetting($name2.'secret', $user->guid );

//if no show two API keys
$r=elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>$name2));

//if(!elgg_get_entities(array('types' => 'object',
	//'subtypes' => 'appname', 'title'=>$name2)))
		if(!get_subtype_id('object','app'.$name2))

	{
	//register_error( elgg_echo("show two application not register!!"));
//forward(REFERER);
echo ($name2."  application not register!!");
}
else
{



		if( elgg_get_entities(array('types' => 'object',
	'subtypes' => 'appname', 'title'=>'app'.$name2,'owner_guid'=> elgg_get_logged_in_user_guid())))

	{
$user_plugin = elgg_get_plugin_from_id('userAPI');

$user2_public = $user_plugin->getUserSetting($name2.'public', $user->guid );
$user2_private = $user_plugin->getUserSetting($name2.'private', $user->guid );
//
/*if($user2_public && $user2_private)
{


///system_message( elgg_echo("you are get token and secret for show two application from:usersettings/configureyourtools/get_token"));
//forward(REFERER);


echo "</br>Your Public key   :  ";
echo $user2_public;
echo "</br>Your private key  :  ";
echo $user2_private;

}

*/
	}
	
	
	
	
	
	
	$entities= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name2.'token','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities)
	{
	foreach($entities as $entity)
	{
		$g_token=$entity->title;
	
	echo "<br/>";
	}
	}

	$entities2= elgg_get_entities(array('types' => 'object',
	'subtypes' => $name2.'secret','owner_guid'=> elgg_get_logged_in_user_guid()));
	if($entities2)
	{
		foreach($entities2 as $entity2)
		{
	$g_secret=$entity2->title;
	
	
	
	}}



if($g_secret =="" && $g_token =="")
{
/*echo "</br>Your Access Secret:  ";
echo $g_secret ;

echo "</br>Your Access Token:  ";
echo $g_token;
}
else
{
*/
echo "</br> You must generate token and secret for use 'addblog' application</br>";
}




echo "</br></br></br>";
}


?>


<div align="center">

<div align="center">
<label><h3>Authorize for comment</h3></label>


<div id="show_keys2" align="left" style="color:green;display:none;">

<h5> <br />Enter your public and private keys<br/></h5>







<h5>Public Key:</h5> <input type="text" id="mypublic2" name="public2" value="<?php echo $user2_public;?>" >
<h5>Private Key:</h5> <input type="text" id="myprivate2" name="private2" value="<?php echo $user2_private;?>"  >

</div>

<script type="text/javascript">
var user2_public="<?php echo $user2_public;?>";
var user2_private="<?php echo $user2_private;?>";

if  ( user2_public && user2_private)//
{
document.getElementById('show_keys2').style.display='inline';
var x=1;
}
else
{
	var x=0;
}

</script>


<div align="left">
<form >
<h5> <br />Enter your access token and secret<br/></h5>

<h5>Secret key:</h5> <input type="text" id="usersecret22" name="usecret22" value="<?php echo $g_secret;?>"  >
<h5>Token key:</h5> <input type="text" id="usertoken22" name="utoken22" value="<?php echo $g_token;?>"  >





<input type="Button" class="elgg_button" value="Authorize" width="610px" onclick = "enter2()" >


<form/>

<div align="center" >

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
<br/>
<h2>---------------------------------------------------------------<h2/>
<h2>---------------------------------------------------------------<h2/>
<br/>
</h2>
<br />
<div align="center">
<label><h3>Generate access token and access secret</h3></label>
<br />
<div align="left">
<h5>Generate access token and secret for  'blog' , 'addblog'  Applications.Allow?</h5>


<br />
<div align="left">




<form>
<h5><input type="radio" name="app" value="showblogs" checked="checked" />blog application</h5>

<h5><input type="radio" name="app" value="addblog" />addblog application</h5>



<h5>Your secret:</h5><input type="text" id="mysecret" name="secret" value="" readonly>

<h5>Your token:</h5><input type="text" id="mytoken" name="token" value="" readonly>

<input type="Button" class="elgg_button" value="Generate access token and secret" width="610px" onclick = "newSecret()" >


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
var two_token="<?php echo $blog_token;?>";
var two_secret="<?php echo $blog_secret;?>";
//alert(two_token);
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
       
 alert("Keys is empry!!!");
    }

else
{
if( user_public == "" || user_private == ""  || two_token== "" || two_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(  (public == user_public) &&(private == user_private) && (secret2 == two_secret) && (token2 == two_token))
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



var two_token="<?php echo $blog_token;?>";
var two_secret="<?php echo $blog_secret;?>";
//alert(two_token);
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
       
 alert("Keys is empry!!!");
    }

else
{
if(  two_token== "" || two_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(   (secret2 == two_secret) && (token2 == two_token))
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


function enter2()
{

//if(document.getElementById('show_keys').style.display='inline')
if(x==1)
{
//alert("ok");

var user2_public="<?php echo $user2_public;?>";
var user2_private="<?php echo $user2_private;?>";
var two_token="<?php echo $g_token;?>";
var two_secret="<?php echo $g_secret;?>";
//alert(two_token);
//alert(user_private);
//var secret= document.getElementById('usersecret').value;
//alert(secret);
var secret2=document.getElementById('usersecret22').value;
var token2=document.getElementById('usertoken22').value;
//var token= document.getElementById('usertoken').value;
//alert(secret);
var public= document.getElementById('mypublic2').value;
var private= document.getElementById('myprivate2').value;

//var public2= document.getElementById('mypublic2').value;
//var private2= document.getElementById('myprivate2').value;

token2=$.trim(token2);
secret2=$.trim(secret2);
public=$.trim(public);
private=$.trim(private);

if( public == "" || private == "" || secret2=="" || token2=="" )
    {
       
 alert("Keys is empry!!!");
    }

else
{
if( user2_public == "" || user2_private == ""  || two_token== "" || two_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(  (public == user2_public) &&(private == user2_private) && (secret2 == two_secret) && (token2 == two_token))
{

//alert("authorized");
document.getElementById('show2').style.display='inline';


  
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



var two_token="<?php echo $g_token;?>";
var two_secret="<?php echo $g_secret;?>";
//alert(two_token);
//alert(user_private);
//var secret= document.getElementById('usersecret').value;
//alert(secret);
var secret2=document.getElementById('usersecret22').value;
var token2=document.getElementById('usertoken22').value;
//var token= document.getElementById('usertoken').value;
//alert(secret);


token2=$.trim(token2);
secret2=$.trim(secret2);

//var public2= document.getElementById('mypublic2').value;
//var private2= document.getElementById('myprivate2').value;


if( token2=="" || secret2=="" )
    {
       
 alert("Keys is empry!!!");
    }

else
{
if(  two_token== "" || two_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(   (secret2 == two_secret) && (token2 == two_token))
{

//alert("authorized");
document.getElementById('show2').style.display='inline';


  
}



else
{
alert("enter Right Keys!");
}
}
}


}
}





function enter3()
{

//if(document.getElementById('show_keys').style.display='inline')
if(x==1)
{
//alert("ok");

var user2_public="<?php echo $user3_public;?>";
var user2_private="<?php echo $user3_private;?>";
var two_token="<?php echo $members_token;?>";
var two_secret="<?php echo $members_secret;?>";
//alert(two_token);
//alert(user_private);
//var secret= document.getElementById('usersecret').value;
//alert(secret);
var secret2=document.getElementById('usersecret222').value;
var token2=document.getElementById('usertoken222').value;
//var token= document.getElementById('usertoken').value;
//alert(secret);
var public= document.getElementById('mypublic3').value;
var private= document.getElementById('myprivate3').value;

//var public2= document.getElementById('mypublic2').value;
//var private2= document.getElementById('myprivate2').value;


token2=$.trim(token2);
secret2=$.trim(secret2);
public=$.trim(public);
private=$.trim(private);
if( public == "" || private == "" || secret2=="" || token2=="" )
    {
       
 alert("Keys is empry!!!");
    }

else
{
if( user2_public == "" || user2_private == ""  || two_token== "" || two_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(  (public == user2_public) &&(private == user2_private) && (secret2 == two_secret) && (token2 == two_token))
{

//alert("authorized");
document.getElementById('show3').style.display='inline';


  
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



var two_token="<?php echo $members_token;?>";
var two_secret="<?php echo $members_secret;?>";
//alert(two_token);
//alert(user_private);
//var secret= document.getElementById('usersecret').value;
//alert(secret);
var secret2=document.getElementById('usersecret222').value;
var token2=document.getElementById('usertoken222').value;
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
if(  two_token== "" || two_secret == "")
{
alert("no  Keys is DB!!!");


}

else
{
if(   (secret2 == two_secret) && (token2 == two_token))
{

//alert("authorized");
document.getElementById('show3').style.display='inline';


  
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
	
	 var path="<?php echo $path;?>";

    xmlhttp.open("GET",path+"mod/twoapp2/views/default/twoapp2/coder.php",true);
    xmlhttp.send();
}
 

</script>













