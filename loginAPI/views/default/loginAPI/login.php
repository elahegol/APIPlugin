<?php
// Elgg login form

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
$secret = md5(time().rand());
		$token = md5(md5(time() .rand()+ time()));
	

?>




<legend>



<div>
    <label ><?php echo elgg_echo("ApplicationName"); ?></label><br />
    <?php echo elgg_view('input/text',array('name' => 'app')); ?>
    </div>

   



</legend>

