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
				echo 'Title : '.getTextBetween($infos, '[title]', '[/title]');
				echo 'Description : '.getTextBetween($infos, '[description]', '[/description]');
				                                                                  //echo getTextBetween('description="Description";', 'description="', '";');
				}
			
			else {
				echo 'nope';
				$file = fopen($content[$i].'/.info.lsp', 'w+'); // création du fichier d'information
				fwrite($file, "[visibility]true[/visibility]\r\n[title]".$content[$i]."[/title]\r\n[description]Description[/description]");
				fclose($file);
				chmod($content[$i].'/.info.lsp', 0557); // modification des droits pour que l'utilisateur puisse modifier le fichier
			}

			echo '<br />';
		}
	}

	function getTextBetween($text, $start, $end){
		
		$startpos = strpos( $text, $start ) + strlen( $start ); 
		$endpos = strpos( $text, $end ); 
		$final = substr( $text, $startpos, $endpos - $startpos ); 

		return $final;
	}
?>