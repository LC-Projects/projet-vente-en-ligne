<?php
declare(strict_types=1);

namespace App\Entity\Categorie;
use App\Entity\Produit\Produit;

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
    public function __construct(int $id, string $nom, string $description)
    {
        $this->id = $id;
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
     * Retourne l'ID de la catégorie.
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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