
<?php
/**
* User settings edit code
* 
*/

	
// get previously saved settings
$guid = elgg_get_page_owner_guid();
$settings = elgg_get_all_plugin_user_settings($guid, 'userAPI');


 $user = elgg_get_logged_in_user_entity();
$username=$user->username;
$user_plugin = elgg_get_plugin_from_id('userAPI');


?>

<div align="left">
<label><h2>User API Keys</h2></label>
<br />

<?php echo " <h2><br />Generate public and private keys</h2><br/>";



echo "<br /><h2> for delete Application , save keys empty!!!!</h2><br />";
?>


<form>
<h3>Your Application Name:</h3> <input type="text" id="apname" name="appname" value="" >
<br>
<h3>Your Public:</h3> <input type="text" id="mypub" name="public" value="" readonly>
<br>
<h3>Your Private:</h3> <input type="text" id="mypri" name="private" value="" readonly>
<input type="Button" class="elgg_button" value="Generate new keys" width="610px" onclick = "newSecret()" >

     <br/>
<br>
<label style="color:#3FF">for save in DB,click save button</label>
</form>



<script type="text/javascript">


function newSecret()
{
    var xstr = "";
    qrurl = "";
    document.getElementById('mypub').value = "";
    document.getElementById('mypri').value = "";
    window.XMLHttpRequest

    {
        xmlhttp = new XMLHttpRequest();
    }
    
    //xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()//event 
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) 
        {
            //alert(xmlhttp.responseText);
          xstr=xmlhttp.responseText;//string barmigardone
        }
    }



 
    xmlhttp.open("POST","http://localhost/elgg-1.11.0/mod/userAPI/views/default/userAPI/coder.php",false);
    xmlhttp.send();
    
    if(xstr != "")
    {
         var res = xstr.split(";");
       document.getElementById('mypri').value = res[1];
        document.getElementById('mypub').value = res[0];
        
    }
    else
    {
        alert("cant create keys!!")
    }
    
    

}


  
</script>

