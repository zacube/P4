<?php

function connexion(): PDO
{
    $host = 'localhost';
    $dbname = 'artbox';
    $port = '3306';
    $username = 'root';
    $password = '';
    $charset = 'utf8';

    try {
        // Crée une nouvelle instance de PDO
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;port=$port;charset=$charset",
            $username,
            $password,
            // pour afficher les messages d'erreurs
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
        return $pdo;
    } catch (PDOException $exception) {
        // Gére les exceptions en affichant un message d'erreur
        die('Erreur de connexion : ' . $exception->getMessage());
    }
}