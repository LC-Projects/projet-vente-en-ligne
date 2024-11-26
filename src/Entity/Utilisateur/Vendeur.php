<?php
declare(strict_types=1);

namespace App\Entity\Utilisateur;

use App\Entity\Produit\Produit;
use App\Entity\Utilisateur\Utilisateur;
use DateTime;

/**
 * Classe représentant un vendeur
 * 
 * @property string $boutique Nom de la boutique du vendeur
 * @property float $commission Commission du vendeur
 */
class Vendeur extends Utilisateur
{
    private string $boutique;
    private float $commission;

    /**
     * Constructeur de la classe Vendeur.
     * 
     * @param int|null $id
     * @param string $nom
     * @param string $email
     * @param string $motDePasse
     * @param DateTime $dateInscription
     * @param array $roles
     * @param string $boutique
     * @param float $commission
     * @throws InvalidArgumentException
     */
    public function __construct(string $prenom, string $nom, string $email, string $motDePasse, DateTime $dateInscription, string $boutique, float $commission)
    {
        parent::__construct($prenom, $nom, $email, $motDePasse, $dateInscription, ['ROLE_VENDEUR']);
        $this->boutique = $boutique;
        $this->commission = $commission;
    }

    /**
     * Retourne le nom de la boutique du vendeur.
     * 
     * @return string
     */
    public function getBoutique(): string
    {
        return $this->boutique;
    }

    /**
     * Définit le nom de la boutique du vendeur.
     * 
     * @param string $boutique
     */
    public function setBoutique(string $boutique): void
    {
        $this->boutique = $boutique;
    }

    /**
     * Retourne la commission du vendeur.
     * 
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }

    /**
     * Définit la commission du vendeur.
     * 
     * @param float $commission
     */
    public function setCommission(float $commission): void
    {
        $this->commission = $commission;
    }

    /**
     * Ajoute un produit à la boutique du vendeur.
     * (Méthode vide pour l'instant)
     * 
     * @param Produit $produit
     * @return void
     */
    public function ajouterProduit(Produit $produit): void
    {
        // Méthode vide pour l'instant
    }

    /**
     * Gère le stock de produits dans la boutique du vendeur.
     * (Méthode vide pour l'instant)
     * 
     * @param Produit $produit
     * @param int $quantite
     * @return void
     */
    public function gererStock(Produit $produit, int $quantite): void
    {
        // Méthode vide pour l'instant
    }

    /**
     * Affiche les rôles de l'utilisateur.
     * 
     * @return string
     */
    public function afficherRoles(): string
    {
        return "Rôles: " . implode(", ", $this->roles);
    }
}
?>