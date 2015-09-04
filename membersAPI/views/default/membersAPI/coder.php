<?php






$secret = md5(time().rand());
		$token = md5(md5(time() .rand()+ time()));



echo $secret.';'.$token;



?>
