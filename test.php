<?php
require_once(__DIR__ . '/jpgraph-4.4.2/src/jpgraph.php');
require_once(__DIR__ . '/jpgraph-4.4.2/src/jpgraph_line.php');
require_once(__DIR__ . '/_DB/connexionDB.php'); // Chemin adapté pour ta connexion


// Définir le type d'image avant toute sortie
header("Content-Type: image/png");

// Vérifier si la connexion à la base de données est bien établie
if (!isset($DB)) {
    die("❌ Erreur : Connexion à la base de données non établie.");
}

try {
    $stmt = $DB->query("SELECT distance, timestamp FROM mesures ORDER BY timestamp DESC LIMIT 20");
    $mesures = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($mesures);
    echo "</pre>";
    exit();
} catch (PDOException $e) {
    die("❌ Erreur SQL lors de la récupération des mesures : " . $e->getMessage());
}

?>
