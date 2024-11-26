<?php
declare(strict_types=1);

namespace App\Entity\Utilisateur;

use App\Entity\Panier;
use App\Entity\Utilisateur\Utilisateur;
use DateTime;

/**
 * Classe représentant un client
 * 
 * @property string $adresseLivraison Adresse de livraison du client
 * @property Panier $panier Panier du client
 */
class Client extends Utilisateur
{
    private string $adresseLivraison;
    private Panier $panier;

    /**
     * Constructeur de la classe Client.
     * 
     * @param int|null $id
     * @param string $nom
     * @param string $email
     * @param string $motDePasse
     * @param DateTime $dateInscription
     * @param array $roles
     * @param string $adresseLivraison
     * @param Panier $panier
     * @throws InvalidArgumentException
     */
    public function __construct(string $prenom, string $nom, string $email, string $motDePasse, DateTime $dateInscription, string $adresseLivraison, Panier $panier)
    {
        parent::__construct($prenom, $nom, $email, $motDePasse, $dateInscription, ['ROLE_CLIENT']);
        $this->adresseLivraison = $adresseLivraison;
        $this->panier = $panier;
    }

    /**
     * Retourne l'adresse de livraison du client.
     * 
     * @return string
     */
    public function getAdresseLivraison(): string
    {
        return $this->adresseLivraison;
    }

    /**
     * Définit l'adresse de livraison du client.
     * 
     * @param string $adresseLivraison
     */
    public function setAdresseLivraison(string $adresseLivraison): void
    {
        $this->adresseLivraison = $adresseLivraison;
    }

    /**
     * Retourne le panier du client.
     * 
     * @return Panier
     */
    public function getPanier(): Panier
    {
        return $this->panier;
    }

    /**
     * Définit le panier du client.
     * 
     * @param Panier $panier
     */
    public function setPanier(Panier $panier): void
    {
        $this->panier = $panier;
    }

    /**
     * Crée une commande à partir des articles présents dans le panier.
     * (Méthode vide pour l'instant)
     * 
     * @return void
     */
    public function passerCommande(): void
    {
        // Méthode vide pour l'instant
    }

    /**
     * Retourne l'historique des commandes passées par le client.
     * (Méthode vide pour l'instant)
     * 
     * @return array
     */
    public function consulterHistorique(): array
    {
        // Méthode vide pour l'instant
        return [];
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