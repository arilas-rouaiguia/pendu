    <?php session_start();?>
    <!DOCTYPE html>
	<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Jeu du Pendu</title>
    </head>
    <body>
    <?php
        include 'admin.php';
        include 'functions.php';
        if (isset($_POST['nouveaumot'])) unset($_SESSION['reponse']);
        if (!isset($_SESSION['reponse']))
        {
            $_SESSION['essais'] = 0;
            $reponse = fetchWordArray($WORDLISTFILE);
            $_SESSION['reponse'] = $reponse;
            $_SESSION['hidden'] = masque($reponse);
            echo 'Essais restants: '.($MAX_ATTEMPTS - $_SESSION['essais']).'<br>';
        }else
        {
            if (isset ($_POST['entree']))
            {
                $entree = $_POST['entree'];
                $_SESSION['hidden'] = checkAndReplace(strtolower($entree), $_SESSION['hidden'], $_SESSION['reponse']);
                Fin($MAX_ATTEMPTS,$_SESSION['essais'], $_SESSION['reponse'],$_SESSION['hidden']);
            }
            $_SESSION['essais'] = $_SESSION['essais'] + 1;
            echo 'Essais restants: '.($MAX_ATTEMPTS - $_SESSION['essais'])."<br>";
			echo "<img src='image/".($MAX_ATTEMPTS - $_SESSION['essais']).".jpg'> <br>";
        }
        $hidden = $_SESSION['hidden'];	
        foreach ($hidden as $char) echo $char."  ";
    ?>
	
    <form name = "inputForm" action = "" method = "post">
    Lettre ou Caractére: <input name = "entree" type = "text" size="1" maxlength="1"  />
    <input type = "submit"  value = "Vérifier" onclick="return validateInput()"/>
    <input type = "submit" name = "nouveaumot" value = "Changer de mot"/>
    </form>
    </body>
    </html>