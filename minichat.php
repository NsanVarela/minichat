<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Mini-chat</title>
    </head>
    
    <body>
        <div class="logo">
            <img src="img/bg_bulle.png" alt="logo">
        </div>
            <h1>MINICHAT</h1>
        
    	
    	<p class="description">MiniChat vous permet de communiquer avec vos amis, <br>d'échanger des messages et de rencontrer des gens.</p>


	    <form action="minichat_post.php" method="post" id="formulaire">
	        <p>
	        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo..." <?php if (isset($_GET['pseudo'])) { echo ' value="' . $_GET['pseudo'] . '"'; }?> /><br /><br />
            <textarea name="message" id="message" rows="8" cols="40" placeholder="Votre message ici..."></textarea><br />
	        <input type="submit" value="Envoyer" />
		</p>
	    </form>

<?php

// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_message, \'%d-%m-%Y à %Hh%imin%ss\') AS date_message_fr FROM minichat ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
	echo '<div  class="discussion">
    <p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> (Le ' . $donnees['date_message_fr'] . ')<br />' . htmlspecialchars($donnees['message']) . '</p>
    </div>';
}

$reponse->closeCursor();

?>
    </body>
</html>