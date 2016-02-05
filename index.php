<?php

	
	$content = scandir ('./');
	
	// on parcourt le répertoire courant
	for($i=0; $i<sizeof($content); $i++){

		// On ne garde que les dossiers et on enève "." et ".."
		if (is_dir ($content[$i]) && $content[$i] != '.' && $content[$i] != '..'){

			print('<a href="'.$content[$i].'">'.$content[$i].'</a>');

			if (file_exists($content[$i].'/.info.lsp')){
				echo ' ok';
				$file = fopen($content[$i].'/.info.lsp', 'r'); // ouverture du fichier d'information en lecture 
				$infos = fread($file, filesize($content[$i].'/.info.lsp'));
				fclose($file);
				echo ' '.$infos;
				}
			
			else {
				echo 'nope';
				$file = fopen($content[$i].'/.info.lsp', 'w+'); // création du fichier d'information
				fwrite($file, "visibility=true;\r\n"."title=".$content[$i].";\r\ndescription=Description;");
				fclose($file);
				chmod($content[$i].'/.info.lsp', 0557); // modification des droits pour que l'utilisateur puisse modifier le fichier
			}

			echo '<br />';
		}
	}

	fonction getTextBetween($text, $start, $end){
		
		$startpos = strpos( $text, $start ) + strlen( $start ); 
		$endpos = strpos( $text, $end ); 
		$final = substr( $text, $startpos, $endpos - $startpos ); 

		return $final;
	}
?>