<?php
$postData = $_GET;
echo '<pre>';
var_dump($postData);
echo '/<pre>';


if (
    empty($postData['titre'])
    || empty($postData['artiste'])
    || empty($postData['image'])
    || empty($postData['description'])
    || strlen($postData['description']) < 3
) {
    header("Location: ajouter.php");
    echo('Veuillez remplir tous  les champs'); // retour vers la page ajouter
    return;
} else {
    foreach ($postData as $postD) {
        echo $postD . "\n";
        $postD = trim(htmlspecialchars(strip_tags($postD)));
        echo $postD . "\n";
    }

}