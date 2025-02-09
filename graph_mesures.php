<?php
header('Content-Type: application/json');
include_once(__DIR__ . '/_DB/connexionDB.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier la connexion
if (!isset($DB)) {
    echo json_encode(["error" => "❌ Erreur : Connexion à la base de données non établie."]);
    exit();
}

// Récupérer les 20 dernières mesures
try {
    $stmt = $DB->query("SELECT distance, timestamp FROM mesures ORDER BY timestamp DESC LIMIT 35");
    $mesures = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode(["error" => "❌ Erreur SQL : " . $e->getMessage()]);
    exit();
}

// Vérifier si la base contient des données
if (empty($mesures)) {
    echo json_encode(["error" => "⚠️ Aucune donnée disponible."]);
    exit();
}

// Formater les timestamps pour affichage correct
foreach ($mesures as &$mesure) {
    $mesure['timestamp'] = date("H:i:s", strtotime($mesure['timestamp']));
}

// Envoyer les données en JSON
echo json_encode($mesures);
exit();
?>
