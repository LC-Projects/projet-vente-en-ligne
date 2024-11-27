<?php
declare(strict_types=1);
namespace App\Entity\Produit;

use App\Config\ConfigurationManager;
use InvalidArgumentException;
/**
 * Classe représentant un produit
 * 
 * @property int $id Identifiant du produit
 * @property string $nom Nom du produit
 * @property float $prix Prix du produit
 * @property string $description Description du produit
 * @property int $stock Stock du produit
 */
abstract class Produit
{
    private $id;
    private $nom;
    private $prix;
    private $description;
    private $stock;

    /**
     * Constructeur de la classe Produit.
     * 
     * @param int|null $id
     * @param string $nom
     * @param float $prix
     * @param string $description
     * @param int $stock
     * @throws InvalidArgumentException
     */
    public function __construct(string $nom, float $prix, string $description, int $stock)
    {
        $this->setNom($nom);
        $this->setPrix($prix);
        $this->setDescription($description);
        $this->setStock($stock);
    }

    /**
     * Retourne l'ID du produit.
     * 
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Retourne le nom du produit.
     * 
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Retourne le prix du produit.
     * 
     * @return float
     */
    public function getPrix(): float
    {
        return round($this->prix, 2);
    }

    /**
     * Retourne la description du produit.
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Retourne le stock du produit.
     * 
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * Définit l'ID du produit.
     * 
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Définit le nom du produit.
     * 
     * @param string $nom
     * @throws InvalidArgumentException
     */
    public function setNom(string $nom): void
    {
        if (empty($nom)) {
            throw new InvalidArgumentException("Le nom ne doit pas être vide.");
        } elseif (!is_string($nom)) {
            throw new InvalidArgumentException("Le nom doit être une chaîne de caractères.");
        }
        $this->nom = $nom;
    }

    /**
     * Définit le prix du produit.
     * 
     * @param float $prix
     * @throws InvalidArgumentException
     */
    public function setPrix(float $prix): void
    {
        if ($prix <= 0) {
            throw new InvalidArgumentException("Le prix doit être positif.");
        } elseif (!is_float($prix)) {
            throw new InvalidArgumentException("Le prix doit être un nombre décimal.");
        }
        $this->prix = $prix;
    }

    /**
     * Définit la description du produit.
     * 
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Définit le stock du produit.
     * 
     * @param int $stock
     * @throws InvalidArgumentException
     */
    public function setStock(int $stock): void
    {
        if ($stock < 0) {
            throw new InvalidArgumentException("Le stock doit être positif ou nul.");
        } elseif (!is_int($stock)) {
            throw new InvalidArgumentException("Le stock doit être un entier.");
        }
        $this->stock = $stock;
    }

    /**
     * Calcule le prix TTC du produit.
     * 
     * @return float
     */
    public function calculerPrixTTC(): float
    {
        $tva = ConfigurationManager::getInstance()->get("tva");
        return round(($this->prix * (1 + $tva)), 2);
    }

    /**
     * Vérifie si la quantité en stock est suffisante.
     * 
     * @param int $quantite
     * @return bool
     */
    public function verifierStock(int $quantite): bool
    {
        return $quantite > 0;
    }
}
?>