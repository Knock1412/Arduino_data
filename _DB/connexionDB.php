<?php
class connexionDB {
    private $host = 'localhost';
    private $name = 'arduino_data';
    private $user = 'root';
    private $pass = ''; 
    private $connexion;

    public function __construct() {
        try {
            $this->connexion = new PDO(
                "mysql:host={$this->host};dbname={$this->name};charset=utf8",
                $this->user, 
                $this->pass, 
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch (PDOException $e) {
            die("❌ Erreur de connexion : " . $e->getMessage());
        }
    }

    public function DB() {
        return $this->connexion;
    }
}

$DBB = new connexionDB();
$DB = $DBB->DB();
?>
