<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "arduino_data";
$username = "root";
$password = ""; // Assure-toi que ton mot de passe est correct

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ Connexion réussie à la base de données.<br>"; // Message de confirmation (peut être retiré après test)
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}

// Vérifier si distance est envoyée
if (isset($_POST['distance']) && is_numeric($_POST['distance'])) {
    $distance = (float) $_POST['distance']; // Convertir en nombre

    try {
        $stmt = $pdo->prepare("INSERT INTO mesures (distance, timestamp) VALUES (:distance, NOW())");
        $stmt->execute(['distance' => $distance]);
        echo "✅ Donnée insérée avec succès.";
    } catch (PDOException $e) {
        echo "❌ Erreur lors de l'insertion : " . $e->getMessage();
    }
} else {
    echo "⚠️ Donnée invalide.";
}
?>
