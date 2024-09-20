<?php
require 'header.php';

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if (empty($_GET['id'])) {
    header('Location: index.php');
}

/*inclusion des variables et fonctions*/
require_once(__DIR__ . '/functions.php');

/* connexion bdd et récupération données*/
$mysql = connexion();
$oeuvre = null;


$sqlQuery = 'SELECT * FROM oeuvres WHERE id=:id';
$oeuvresStatement = $mysql->prepare($sqlQuery);
$oeuvresStatement->execute(['id' => $_GET['id']]);
$oeuvre = $oeuvresStatement->fetchAll(PDO::FETCH_ASSOC);
$oeuvre = $oeuvre[0];
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
            <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
