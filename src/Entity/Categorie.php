<?php
declare(strict_types=1);

namespace App\Entity;
use App\Entity\Produit\Produit;
use InvalidArgumentException;

/**
 * Classe représentant une catégorie de produits
 * 
 * @property int $id Identifiant de la catégorie
 * @property string $nom Nom de la catégorie
 * @property string $description Description de la catégorie
 * @property array $produits Tableau des produits dans la catégorie
 */
class Categorie
{
    private int $id;
    private string $nom;
    private string $description;
    private array $produits;

    /**
     * Constructeur de la classe Categorie.
     * 
     * @param int $id
     * @param string $nom
     * @param string $description
     */
    public function __construct(string $nom, string $description)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->produits = [];
    }

    /**
     * Ajoute un produit à la catégorie.
     * 
     * @param Produit $produit
     * @return void
     */
    public function ajouterProduit(Produit $produit): void
    {
        $this->produits[] = $produit;
    }

    /**
     * Retire un produit de la catégorie.
     * 
     * @param Produit $produit
     * @return void
     */
    public function retirerProduit(Produit $produit): void
    {
        foreach ($this->produits as $key => $p) {
            if ($p === $produit) {
                unset($this->produits[$key]);
                $this->produits = array_values($this->produits); // Reindex array
                break;
            }
        }
    }

    /**
     * Retourne un tableau des produits dans la catégorie.
     * 
     * @return array
     */
    public function listerProduits(): array
    {
        return $this->produits;
    }

    /**
     * Définit l'ID de la catégorie.
     * 
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Retourne l'ID de la catégorie.
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Définit le nom de la catégorie.
     * 
     * @param string $nom
     * @throws InvalidArgumentException
     */
    public function setNom(string $nom): void
    {
        if (empty($nom)) {
            throw new InvalidArgumentException("Le nom de la catégorie ne peut pas être vide.");
        } elseif (strlen($nom) > 50) {
            throw new InvalidArgumentException("Le nom de la catégorie ne peut pas dépasser 50 caractères.");
        }
        $this->nom = $nom;
    }

    /**
     * Retourne le nom de la catégorie.
     * 
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Définit la description de la catégorie.
     * 
     * @param string $description
     * @throws InvalidArgumentException
     */
    public function setDescription(string $description): void
    {
        if (empty($description)) {
            throw new InvalidArgumentException("La description de la catégorie ne peut pas être vide.");
        } elseif (strlen($description) > 255) {
            throw new InvalidArgumentException("La description de la catégorie ne peut pas dépasser 255 caractères.");
        }
        $this->description = $description;
    }

    /**
     * Retourne la description de la catégorie.
     * 
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
?>