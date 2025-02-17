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
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">📡 Projet Arduino Ultrason</a>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center text-primary">📊 Graphique des Mesures</h2>

    <div class="card p-4 shadow-sm">
        <canvas id="graphMesures"></canvas>
    </div>
</div>

<!-- Chargement du Graph -->
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
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
                borderWidth: 2,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: 'red'
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

    setInterval(fetchData, 5000);
    fetchData();
</script>

</body>
</html>
