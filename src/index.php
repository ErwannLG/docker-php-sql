<?php
const DBHOST = 'db';
const DBNAME = 'projet';
const DBUSER = 'test';
const DBPASS = 'test';

$dsn = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8';

try {
    $db = new PDO($dsn, DBUSER, DBPASS);

    echo "Connexion réussie 👍❤️♥</br>";
  }
  // On capture les exceptions et on affiche le message d'erreur
  catch(PDOException $e){
    echo "connection failed: " . $e->getMessage() . "</br>";
}

$sql = "SELECT * FROM users";
// Préparation de la requête
$query = $db->prepare($sql);
// Exécution de la requête
$query->execute();
// Stockage du résultat dans un tableau associatif
$users = $query->fetchAll(PDO::FETCH_ASSOC);

$db = null;

// echo "<pre>";
// print_r($users);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Mon premier site qui fonctionne sur Docker! Ou pas?</h1>
    <?php
        foreach($users as $user) {
    ?>
        <div><?= $user['first_name'] . ' ' . $user['last_name'] ?> est gentil</div>
    <?php
        }
    ?>
</body>
</html>