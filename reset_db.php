<?php
// Connexion à la base de données
include_once(__DIR__ . '/_DB/connexionDB.php');
include_once(__DIR__ . '/includes/navbar.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Vider uniquement la table 'mesures' (et pas 'logins' qui n'existe pas)
        $DB->exec("TRUNCATE TABLE mesures");
        echo "✅ Table 'mesures' vidée avec succès.";
    } catch (PDOException $e) {
        echo "❌ Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser la base</title>
</head>
<body>
    <h2>Réinitialisation de la base de données</h2>
    <form method="post" onsubmit="return confirm('Voulez-vous vraiment vider la base de données ?');">
        <button type="submit" style="background-color: red; color: white; padding: 10px; border: none; cursor: pointer;">Vider la base de données</button>
    </form>
</body>
</html>
