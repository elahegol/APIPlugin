<?php
global $CONFIG;
	$site_guid=$CONFIG->site_id;
 $public = sha1(rand().$site_guid . microtime());
 $private = sha1(rand() . $site_guid . microtime() . $public);


echo $public.';'.$private;


?>
