<?php
declare(strict_types=1);

namespace App\Database;

use App\Config\ConfigurationManager;
use InvalidArgumentException;
use PDO;
use PDOException;


/**
 * Class DatabaseConnection
 * 
 * Permet de se connecter à la base de données.
 */
class DatabaseConnection {

    private static $instance;
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    /**
     * Constructeur de la classe DatabaseConnection.
     * 
     * @throws InvalidArgumentException
     */
    private function __construct() {
        $configManager = ConfigurationManager::getInstance();
        $this->host = $configManager->get('DB_HOST');
        $this->port = $configManager->get('DB_PORT');
        $this->dbname = $configManager->get('DB_NAME');
        $this->username = $configManager->get('DB_USER');
        $this->password = $configManager->get('DB_PASS');
    }

    /**
     * Return an instance of the DatabaseConnection class.
     * 
     * @return DatabaseConnection
     */
    public static function getInstance(): DatabaseConnection {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    /**
     * Connect to the database and return the PDO object.
     * 
     * @return PDO
     * @throws InvalidArgumentException
     */
    public function connect() {
        if ($this->pdo === null) {
            try {
                $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname;
                $this->pdo = new PDO($dsn, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new InvalidArgumentException("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}