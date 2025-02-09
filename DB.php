<?php
$titre = "Visualisation des mesures";
include_once(__DIR__ . '/includes/navbar.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre) ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .graph-container {
            width: 80%;
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<h1>📊 Graphique en temps réel</h1>

<div class="graph-container">
    <canvas id="graphMesures"></canvas>
</div>

<script>
    async function fetchData() {
        try {
            let response = await fetch("graph_mesures.php");
            let data = await response.json();

            if (data.error) {
                console.error("Erreur:", data.error);
                return;
            }

            let labels = data.map(m => m.timestamp);
            let distances = data.map(m => parseFloat(m.distance));

            updateChart(labels, distances);
        } catch (error) {
            console.error("Erreur de récupération des données:", error);
        }
    }

    function updateChart(labels, data) {
        myChart.data.labels = labels;
        myChart.data.datasets[0].data = data;
        myChart.update();
    }

    const ctx = document.getElementById('graphMesures').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Distance (cm)',
                data: [],
                borderColor: 'blue',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: "Heure" }},
                y: { title: { display: true, text: "Distance (cm)" }, beginAtZero: true }
            }
        }
    });

    // Rafraîchir les données toutes les 5 secondes
    setInterval(fetchData, 5000);
    fetchData();
</script>

</body>
</html>
