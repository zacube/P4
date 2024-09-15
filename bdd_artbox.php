<?php

try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=artbox;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT * FROM oeuvres';
$oeuvresStatement = $mysqlClient->prepare($sqlQuery);
$oeuvresStatement->execute();
$oeuvres = $oeuvresStatement->fetchAll(PDO::FETCH_ASSOC);

foreach ($oeuvres as $oeuvre){
?>
<pre><?php print_r($oeuvre); ?></pre>
<?php
}
?>

