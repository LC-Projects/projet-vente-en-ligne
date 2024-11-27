<?php
declare(strict_types=1);
namespace App\Entity\Produit;

use App\Entity\Config\ConfigurationManager;
use DateTime;
use InvalidArgumentException;

/**
 * Classe représentant un produit périssable
 */
class ProduitPerissable extends Produit
{
    private DateTime $dateExpiration;
    private float $temperatureStockage;

    /**
     * Constructeur de la classe ProduitPerissable.
     * 
     * @param string $nom
     * @param float $prix
     * @param string $description
     * @param int $stock
     * @param DateTime $dateExpiration
     * @param float $temperatureStockage
     * @throws InvalidArgumentException
     */
    public function __construct(string $nom, float $prix, string $description, int $stock, DateTime $dateExpiration, float $temperatureStockage)
    {
        parent::__construct($nom, $prix, $description, $stock);
        $this->setDateExpiration($dateExpiration);
        $this->setTemperatureStockage($temperatureStockage);
    }


    /**
     * Définit la date d'expiration du produit.
     * 
     * @param DateTime $dateExpiration
     * @throws InvalidArgumentException
     */
    public function setDateExpiration(DateTime $dateExpiration): void
    {
        $now = new DateTime();
        if ($dateExpiration < $now) {
            throw new InvalidArgumentException("La date d'expiration doit être postérieure à la date actuelle.");
        }
        $this->dateExpiration = $dateExpiration;
    }

    /**
     * Définit la température de stockage du produit.
     * 
     * @param float $temperatureStockage
     * @throws InvalidArgumentException
     */
    public function setTemperatureStockage(float $temperatureStockage): void
    {
        if ($temperatureStockage < ConfigurationManager::getInstance()->get("temperature_stockage_minimale") || $temperatureStockage > ConfigurationManager::getInstance()->get("temperature_stockage_maximale")) {
            throw new InvalidArgumentException("La température de stockage doit être comprise entre " . ConfigurationManager::getInstance()->get("temperature_stockage_minimale") . "°C et " . ConfigurationManager::getInstance()->get("temperature_stockage_maximale") . "°C.");
        }
        $this->temperatureStockage = $temperatureStockage;
    }

    /**
     * Vérifie si le produit est périmé par rapport à la date actuelle.
     * 
     * @return bool
     */
    public function estPerime(): bool
    {
        $now = new DateTime();
        return $this->dateExpiration < $now;
    }

    /**
     * Calcule les frais de livraison du produit avec une majoration de 5 $ pour les produits frais.
     * 
     * @return float
     */
    public function calculerFraisLivraison(): float
    {
        $frais = ConfigurationManager::getInstance()->get("frais_de_livraison_de_base");
        return round($frais + 5, 2);
    }

    /**
     * Affiche les détails du produit.
     * 
     * @return void
     */
    public function afficherDetails(): void
    {
        echo "Nom: " . $this->getNom() . "\n";
        echo "Prix: " . $this->getPrix() . "\n";
        echo "Description: " . $this->getDescription() . "\n";
        echo "Stock: " . $this->getStock() . "\n";
        echo "Date d'expiration: " . $this->dateExpiration->format('Y-m-d') . "\n";
        echo "Température de stockage: " . $this->temperatureStockage . "°C\n";
    }
}
?>