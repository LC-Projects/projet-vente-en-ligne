<?php
declare(strict_types=1);
namespace App\Entity\Produit;

use App\Entity\Config\ConfigurationManager;
use DateTime;

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
        $this->dateExpiration = $dateExpiration;
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