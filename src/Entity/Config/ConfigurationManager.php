<?php
declare(strict_types=1);

namespace App\Entity\Config;
use InvalidArgumentException;

class ConfigurationManager {

    private static $instance;
    private $config;
    private $expectedTypes;

    public function __construct() {
        $configFilePath = __DIR__ . '/config.ini';
        if (!file_exists($configFilePath)) {
            throw new InvalidArgumentException("Configuration file not found: $configFilePath");
        }
        $this->config = parse_ini_file($configFilePath, true);
        if ($this->config === false) {
            throw new InvalidArgumentException("Error parsing configuration file: $configFilePath");
        }
        $this->expectedTypes = [
            'tva' => 'float',
            'devise' => 'string',
            'frais_de_livraison_de_base' => 'float',
            'email_de_contact' => 'string',
        ];
    }

    public static function getInstance(): ConfigurationManager {
        if (self::$instance === null) {
            self::$instance = new self();
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
        $type = gettype($value);

        if ($type == $this->expectedTypes[$key]) {
            $this->config[$key] = $value;
        } else {
            throw new InvalidArgumentException("Type mismatch for key $key. Expected type: {$this->expectedTypes[$key]}, got: $type");
        }

    }
}