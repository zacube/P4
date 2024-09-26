<?php
// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if (empty($_GET['id'])) {
    header('Location: index.php');
}

/*connexion à la base de données -> $mysql*/
require_once(__DIR__ . '/bdd.php');

$oeuvre = null;

/* récupération données*/
$requete = 'SELECT * FROM oeuvres WHERE id=:id';
$oeuvresStatement = $pdo->prepare($requete);
$oeuvresStatement->execute(['id' => $_GET['id']]);
$oeuvre = $oeuvresStatement->fetch(PDO::FETCH_ASSOC);
if (count($oeuvre)=== 0 ){
    header('Location: index.php');
}

require 'header.php';
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
