<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
    $dbs = $client->listDatabases();

    echo "✅ Connexion réussie à MongoDB !\n\n";
    echo "Bases de données présentes :\n";
    foreach ($dbs as $db) {
        echo "- " . $db->getName() . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur de connexion à MongoDB : " . $e->getMessage();
}
