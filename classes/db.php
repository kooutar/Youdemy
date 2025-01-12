<?php

class database {
    private static ?database $instance = null; // Singleton instance de la classe database
    private PDO $connection; // Connexion PDO

    private function __construct() {
        // Configuration de la connexion PDO
        $dsn = 'mysql:host=localhost;dbname=Youdemy';
        $username = 'root';
        $password = '';

        try {
            $this->connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Méthode pour obtenir l'instance unique de la classe database
    public static function getInstance(): database {
        if (self::$instance === null) {
            self::$instance = new self(); // Crée une nouvelle instance de la classe database
        }
        return self::$instance;
    }

    // Méthode pour obtenir l'objet PDO
    public function getConnection(): PDO {
        return $this->connection;
    }
}
