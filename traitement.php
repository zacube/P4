<?php
// Initialiser les variables
$titre = $artiste = $image = $description = '';
$errors = [];

// supprime les balises html, convertit les caractères spéciaux et supprime les espaces avant et après
function verif($tmp) {
    $tmp = trim(htmlspecialchars(strip_tags($tmp)));
    return $tmp;
}

// Vérifie si le formulaire a été soumis avec POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // vérifie titre
    if (empty($_POST["titre"])) {
        $errors['titre'] = "Veuillez indiquer le titre de l'œuvre.";
    } else {
        $titre = verif($_POST["titre"]);
    }

    // Vérifie artiste
    if (empty($_POST["artiste"])) {
        $errors['artiste'] = "Veuillez indiquer le nom de l'artiste.";
    } else {
        $artiste = verif($_POST["artiste"]);
    }

    // Vérifie URL de l'image
    if (empty($_POST["image"])) {
        $errors['image'] = "Veuillez indiquer l'URL de l'image.";
    } elseif (!filter_var($_POST["image"], FILTER_VALIDATE_URL)) {
        $errors['image'] = "L'URL indiquée n'est pas valide.";
        $image = verif($_POST["image"]);
    } else {
        $image = verif($_POST["image"]);
    }

    // Vérifie description
    if (empty($_POST["description"])) {
        $errors['description'] = "Veuillez écrire une description de l'œuvre.";
    } elseif (strlen($_POST["description"]) < 3) {
        $errors['description'] = "Veuillez rentrer au moins 3 caractères... :)";
        $description = verif($_POST["description"]);
    } else {
        $description = verif($_POST["description"]);
    }

    // S'il y a des erreurs, renvoie vers le formulaire avec les données et les erreurs
    if (!empty($errors)) {
        session_start();
        $_SESSION['titre'] = $titre;
        $_SESSION['artiste'] = $artiste;
        $_SESSION['image'] = $image;
        $_SESSION['description'] = $description;
        $_SESSION['errors'] = $errors;
        // Redirection vers le formulaire
        header("Location: ajouter.php");
        exit;
    } else {
        /*connexion à la base de données -> PDO $mysql*/
        require_once(__DIR__ . '/bdd.php');

        /* envoi données*/
        $requete = 'INSERT INTO oeuvres (artiste, titre, description, image) VALUES (:artiste, :titre, :description, :image)';
        $declaration = $pdo->prepare($requete);
        $declaration->execute([
            ':artiste' => $artiste,
            ':titre' => $titre,
            ':description' => $description,
            ':image' => $image
        ]);
        //récupère l'ID dans la db et renvoie vers la page de l'oeuvre insérée
        $lastID = $pdo->lastInsertId();
        header("Location:oeuvre.php?id=$lastID");
        exit;

    }
} else {
    //Si le formulaire n'a pas été soumis avec POST, renvoie vers le formulaire
    header("Location: ajouter.php");
    exit;
}
?>
