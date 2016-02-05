<?php

	
	$content = scandir ('./');
	
	for($i=0; $i<sizeof($content); $i++){
		// On ne garde que les dossiers et on enève "." et ".."
		if (is_dir ($content[$i]) && $content[$i] != '.' && $content[$i] != '..'){

			print('<a href="'.$content[$i].'">'.$content[$i].'</a><br />');

		}
	}

?>