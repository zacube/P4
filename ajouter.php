<?php
session_start();
require 'header.php';

// récupère les données et les erreurs depuis traitement.php
$titre = isset($_SESSION['titre']) ? $_SESSION['titre'] : '';
$artiste = isset($_SESSION['artiste']) ? $_SESSION['artiste'] : '' ;
$image = isset($_SESSION['image']) ? $_SESSION['image'] : '';
$description = isset($_SESSION['description']) ? $_SESSION['description'] : '';
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

// Supprime les variables de session
session_unset();
?>

<!--affichage du formulaire-->
<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" value="<?= $titre; ?>" style="<?= isset($errors['titre']) ? 'border:solid 1px red' : '' ?>" required>
        <span style="color:red; font-size:.8em; text-align:center; background-color:#ffe5e5"><?= isset($errors['titre']) ? $errors['titre'] : '' ?></span>
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste"  id="artiste" value="<?= $artiste; ?>" style="<?= isset($errors['artiste']) ? 'border:solid 1px red' : '' ?>" required>
        <span style="color:red; font-size:.8em; text-align:center; background-color:#ffe5e5"><?= isset($errors['artiste']) ? $errors['artiste'] : '' ?></span>
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="text" name="image" id="image" placeholder="https://example.com"  value="<?= $image; ?>" style="<?= isset($errors['image']) ? 'border:solid 1px red; color:#792d2d; font-style:italic' : '' ?>" required>
        <span style="color:red; font-size:.8em; text-align:center; background-color:#ffe5e5"><?= isset($errors['image']) ? $errors['image'] : '' ?></span>
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" style="<?= isset($errors['description']) ? 'border:solid 1px red' : '' ?>" required><?= $description; ?></textarea>
        <span style="color:red; font-size:.8em; text-align:center; background-color:#ffe5e5"><?= isset($errors['description']) ? $errors['description'] : '' ?></span>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>
