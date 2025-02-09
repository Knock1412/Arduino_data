<?php
$titre = "Projet Arduino Ultrason";
include_once(__DIR__ . '/includes/navbar.php'); // Inclure la barre de navigation
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
        }
        h1 {
            color: #007BFF;
        }
        p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🚀 Projet Arduino Ultrason</h1>
    <p>Bienvenue sur le projet Arduino qui enregistre et affiche les mesures de distance d'un capteur ultrason.</p>
    <p>Utilisez la barre de navigation pour consulter les mesures et gérer la base de données.</p>
</div>

</body>
</html>
