<?php
/*connexion à la base de données -> $mysql*/
require_once(__DIR__ . '/bdd.php');

/* récupération données*/
$requete = 'SELECT * FROM oeuvres';
$oeuvresStatement = $pdo->prepare($requete);
$oeuvresStatement->execute();
$oeuvres = $oeuvresStatement->fetchAll(PDO::FETCH_ASSOC);

require 'header.php';

?>
<div class="liste-oeuvres">
    <?php foreach ($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
