    <?php

        function fetchWordArray($wordFile) //Récupération du mot/Fichier Mot
        {
            $ficher = fopen($wordFile,'r');
               if ($ficher)
            {
                $random_ligne = null;
                $ligne = null;
                $count = 0;
                while (($ligne = fgets($ficher)) !== false) 
                {
                    $count++;
                    if(rand() % $count == 0) 
                    {
                          $random_ligne = trim($ligne);
                    }
            }
            if (!feof($ficher)) 
            {
                fclose($ficher);
                return null;
            }else 
            {
                fclose($ficher);
            }
        }
            $reponse = str_split($random_ligne);
            return $reponse;
        }


       

	   function masque($reponse)
        {
            $noOfHiddenChars = floor((sizeof($reponse)/2) + 1);
            $count = 0;
            $hidden = $reponse;
            while ($count < $noOfHiddenChars )
            {
                $random = rand(0,sizeof($reponse)-2);
                if( $hidden[$random] != '_' )
                {
                    $hidden = str_replace($hidden[$random],'_',$hidden,$replace_count);
                    $count = $count + $replace_count;
                }
            }
            return $hidden;
        }
    
	
	
	//Fonction vérification/remplacement
        function checkAndReplace($entree, $hidden, $reponse)
        {
            $i = 0;
            $faux = true;
            while($i < count($reponse))
            {
                if ($reponse[$i] == $entree)
                {
                    $hidden[$i] = $entree;
                    $faux = false;
                }
                $i = $i + 1;
            }
            if (!$faux) $_SESSION['essais'] = $_SESSION['essais'] - 1;
            return $hidden;
        }
        
        
    
	
	//Function de Fin (Victoire et Défaite)
        function Fin($MAX_ATTEMPTS,$essaiuser, $reponse, $hidden)
        {
            if ($essaiuser >= $MAX_ATTEMPTS)
                {
                    echo "Perdu! Le mot était :  ";
                    foreach ($reponse as $letter) echo $letter;
                    echo "<br/><a href='index.php'>Rejouer?</a><br>";
					echo '<img src="image/p.png">';
                    die();
                }
                if ($hidden == $reponse)
                {
                    echo "Gagné! Le mot était : ";
                    foreach ($reponse as $letter) echo $letter;
                    echo "<br/><a href='index.php'>Rejouer?</a><br>";
					echo '<img src="https://media.tenor.com/images/9d1bd590f305e4b7f03c9f0287a1ab7c/tenor.gif"><br>';
					die();
                }
        }
    ?>