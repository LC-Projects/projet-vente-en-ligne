<?php
declare(strict_types=1);

namespace App\Entity\Config;
use InvalidArgumentException;

/**
 * Classe ConfigurationManager
 */
class ConfigurationManager {

    private static $instance;
    private $config;

    /**
     * Constructeur de la classe ConfigurationManager.
     * 
     * @throws InvalidArgumentException
     */
    private function __construct() {
        $configFilePath = __DIR__ . '/config.ini';
        if (!file_exists($configFilePath)) {
            throw new InvalidArgumentException("Configuration file not found: $configFilePath");
        }
        $this->config = parse_ini_file($configFilePath, true);
        if ($this->config === false) {
            throw new InvalidArgumentException("Error parsing configuration file: $configFilePath");
        }
    }

    /**
     * Retourne l'instance unique de ConfigurationManager.
     * 
     * @return ConfigurationManager
     */
    public static function getInstance(): ConfigurationManager {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Retourne la valeur associée à une clé de configuration.
     * 
     * @param string $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $key) {
        if (!array_key_exists($key, $this->config)) {
            throw new InvalidArgumentException("La clé $key n'existe pas dans le fichier de configuration.");
        }
        return $this->config[$key];
    }
}