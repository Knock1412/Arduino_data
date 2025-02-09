<nav>
    <ul>
        <li><a href="index.php">🏠 Accueil</a></li>
        <li><a href="DB.php">📊 Voir les mesures</a></li>
        <li><a href="reset_db.php">🗑️ Réinitialiser la base</a></li>
    </ul>
</nav>

<style>
    nav {
        background-color: #007BFF;
        padding: 10px;
        text-align: center;
    }
    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    nav ul li {
        display: inline;
    }
    nav ul li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background 0.3s;
    }
    nav ul li a:hover {
        background-color: #0056b3;
    }
</style>
