<?php

/**
 * Classe de base pour gérer la connexion à la base de données
 */
class BaseModel {
    /**
     * Instance de la connexion PDO
     * @var PDO
     */
    protected static $pdo;

    /**
     * Initialisation de la connexion PDO avec les paramètres de connexion
     *
     * @param string $host L'hôte de la base de données
     * @param string $dbname Le nom de la base de données
     * @param string $username Le nom d'utilisateur pour se connecter
     * @param string $password Le mot de passe pour se connecter
     * @throws Exception Si la connexion échoue
     */
    public static function init($host, $dbname, $username, $password) {
        if (!isset(self::$pdo)) { // Éviter de recréer la connexion
            try {
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
                self::$pdo = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
    }

    /**
     * Retourne l'instance PDO
     * @return PDO Instance de connexion
     * @throws Exception Si la connexion PDO n'est pas encore initialisée
     */
    public static function getPDO() {
        if (!isset(self::$pdo)) {
            throw new Exception("La connexion PDO n'a pas été initialisée. Veuillez appeler BaseModel::init() d'abord.");
        }
        return self::$pdo;
    }
}

?>
