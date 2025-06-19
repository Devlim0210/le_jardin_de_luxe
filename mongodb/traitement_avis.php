<?php
// Ce fichier traite les données envoyées par le formulaire d'avis
// et les enregistre dans une base MongoDB.

// On inclut l'autoloader de Composer (nécessaire pour MongoDB moderne)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

// Connexion à MongoDB (en local)
$client = new Client("mongodb://localhost:27017");

// Sélection de la base de données et de la collection
$collection = $client->le_jardin_de_luxe->avis;

// Vérification que le formulaire a bien été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et sécurisation des données envoyées
    $nom = htmlspecialchars($_POST['nom']);
    $message = htmlspecialchars($_POST['message']);

    // Création d'un document (équivalent à une ligne SQL)
    $document = [
        'nom' => $nom,
        'message' => $message,
        'date' => new MongoDB\BSON\UTCDateTime(),
    ];

    // Insertion dans MongoDB
    $collection->insertOne($document);

    // Redirection après insertion (par exemple vers la page des avis)
    header('Location: avis.php');
    exit;
} else {
    // Si quelqu’un essaie d'accéder à ce fichier sans formulaire
    echo "Accès interdit.";
}
// jai évité SQL pour les avis, car ils sont non structurés et plus adaptés au NoSQL
