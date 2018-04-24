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

// Récupération des champs de formulaire et sécurisation
  //
  $pseudo  = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : "";
  $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : "";

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO minichat (pseudo, message, date_message) VALUES(?, ?, NOW())');
$req->execute(array($_POST['pseudo'], $_POST['message']));



// Redirection du visiteur vers la page du minichat
header('Location: minichat.php?pseudo=' . $_POST['pseudo']);
?>