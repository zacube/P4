<?php

try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=partage_de_recettes;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT titlee,author FROM recipes WHERE is_enabled = 0';
$Statement = $mysqlClient->prepare($sqlQuery);
$Statement->execute();
$users = $Statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user){
?>
<pre><?php print_r($user); ?></pre>
<?php
}
?>

