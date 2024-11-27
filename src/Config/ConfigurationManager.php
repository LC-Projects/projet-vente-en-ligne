<?php
declare(strict_types=1);

namespace App\Config;

use InvalidArgumentException;
use Dotenv\Dotenv;

class ConfigurationManager {

    private static $instance;
    private $config;

    /**
     * Constructeur de la classe ConfigurationManager.
     * 
     * @throws InvalidArgumentException
     */
    private function __construct() {
        $this->config = [];

        // Load and parse the .ini file
        $configFilePath = __DIR__ . '/config.ini';
        if (file_exists($configFilePath)) {
            $iniConfig = parse_ini_file($configFilePath, true);
            if ($iniConfig === false) {
                throw new InvalidArgumentException("Error parsing configuration file: $configFilePath");
            }
            $this->config = array_merge($this->config, $iniConfig);
        }

        // Load and parse the .env file
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $envConfig = $_ENV;
        $this->config = array_merge($this->config, $envConfig);
    }

    public static function getInstance(): ConfigurationManager {
        if (self::$instance === null) {
            self::$instance = new ConfigurationManager();
        }
        return self::$instance;
    }

    public function get(string $key) {
        if (!array_key_exists($key, $this->config)) {
            throw new InvalidArgumentException("La clé $key n'existe pas dans le fichier de configuration.");
        }
        return $this->config[$key];
    }

    public function set(string $key, $value): void {
        $this->config[$key] = $value;
    }
}