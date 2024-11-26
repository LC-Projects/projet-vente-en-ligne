<?php

declare(strict_types=1);
namespace App\Entity\Produit;

use App\Entity\Config\ConfigurationManager;
use InvalidArgumentException;

/**
 * Classe représentant un produit physique
 */
class ProduitPhysique extends Produit
{
    private float $poids;
    private float $longueur;
    private float $largeur;
    private float $hauteur;

    /**
     * Constructeur de la classe ProduitPhysique.
     * 
     * @param string $nom
     * @param float $prix
     * @param string $description
     * @param int $stock
     * @param float $poids
     * @param float $longueur
     * @param float $largeur
     * @param float $hauteur
     * @throws InvalidArgumentException
     */
    public function __construct(string $nom, float $prix, string $description, int $stock, float $poids, float $longueur, float $largeur, float $hauteur)
    {
        parent::__construct($nom, $prix, $description, $stock);
        $this->setPoids($poids);
        $this->setLongueur($longueur);
        $this->setLargeur($largeur);
        $this->setHauteur($hauteur);
    }

    /**
     * Définit le poids du produit.
     * 
     * @param float $poids
     * @throws InvalidArgumentException
     */
    public function setPoids(float $poids): void
    {
        if ($poids <= 0) {
            throw new InvalidArgumentException("Le poids doit être positif.");
        }
        $this->poids = $poids;
    }

    /**
     * Définit la longueur du produit.
     * 
     * @param float $longueur
     * @throws InvalidArgumentException
     */
    public function setLongueur(float $longueur): void
    {
        if ($longueur <= 0) {
            throw new InvalidArgumentException("La longueur doit être positive.");
        }
        $this->longueur = $longueur;
    }

    /**
     * Définit la largeur du produit.
     * 
     * @param float $largeur
     * @throws InvalidArgumentException
     */
    public function setLargeur(float $largeur): void
    {
        if ($largeur <= 0) {
            throw new InvalidArgumentException("La largeur doit être positive.");
        }
        $this->largeur = $largeur;
    }

    /**
     * Définit la hauteur du produit.
     * 
     * @param float $hauteur
     * @throws InvalidArgumentException
     */
    public function setHauteur(float $hauteur): void
    {
        if ($hauteur <= 0) {
            throw new InvalidArgumentException("La hauteur doit être positive.");
        }
        $this->hauteur = $hauteur;
    }

    /**
     * Calcule les frais de livraison du produit.
     * 
     * @return float
     */
    public function calculerFraisLivraison(): float
    {
        $frais = ConfigurationManager::getInstance()->get("frais_de_livraison_de_base");
        return round($this->poids * $frais, 2);
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
        echo "Poids: " . $this->poids . "\n";
        echo "Dimensions: " . $this->longueur . " x " . $this->largeur . " x " . $this->hauteur . "\n";
    }
}
?>