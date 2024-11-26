<?php
declare(strict_types=1);

namespace App\Entity;
use App\Entity\Produit\Produit;
use DateTime;

/**
 * Classe représentant un panier d'achats
 * 
 * @property array $articles Tableau associatif des articles dans le panier
 * @property DateTime $dateCreation Date de création du panier
 */
class Panier
{
    private array $articles;
    private DateTime $dateCreation;

    /**
     * Constructeur de la classe Panier.
     * 
     * @param DateTime $dateCreation
     */
    public function __construct(DateTime $dateCreation)
    {
        $this->articles = [];
        $this->dateCreation = $dateCreation;
    }

    /**
     * Ajoute un produit au panier avec une quantité spécifiée.
     * 
     * @param Produit $produit
     * @param int $quantite
     * @return void
     */
    public function ajouterArticle(Produit $produit, int $quantite): void
    {
        $id = $produit->getId();
        if (isset($this->articles[$id])) {
            $this->articles[$id]['quantite'] += $quantite;
        } else {
            $this->articles[$id] = ['produit' => $produit, 'quantite' => $quantite];
        }
    }

    /**
     * Retire une quantité spécifiée d'un produit du panier.
     * 
     * @param Produit $produit
     * @param int $quantite
     * @return void
     */
    public function retirerArticle(Produit $produit, int $quantite): void
    {
        $id = $produit->getId();
        if (isset($this->articles[$id])) {
            $this->articles[$id]['quantite'] -= $quantite;
            if ($this->articles[$id]['quantite'] <= 0) {
                unset($this->articles[$id]);
            }
        }
    }

    /**
     * Vide le panier de tous ses articles.
     * 
     * @return void
     */
    public function vider(): void
    {
        $this->articles = [];
    }

    /**
     * Calcule et retourne le total du panier en tenant compte du prix TTC de chaque produit.
     * 
     * @return float
     */
    public function calculerTotal(): float
    {
        $total = 0.0;
        foreach ($this->articles as $article) {
            $total += $article['produit']->calculerPrixTTC() * $article['quantite'];
        }
        return $total;
    }

    /**
     * Retourne le nombre total d'articles dans le panier.
     * 
     * @return int
     */
    public function compterArticles(): int
    {
        $totalQuantite = 0;
        foreach ($this->articles as $article) {
            $totalQuantite += $article['quantite'];
        }
        return $totalQuantite;
    }

    /**
     * Retourne les articles du panier.
     * 
     * @return array
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * Retourne la date de création du panier.
     * 
     * @return DateTime
     */
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }
}
?>