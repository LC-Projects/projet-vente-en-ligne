<?php
declare(strict_types=1);

namespace App\Entity\Utilisateur;
use App\Entity\Utilisateur\Utilisateur;
use DateTime;

/**
 * Classe représentant un administrateur
 * 
 * @property int $niveauAcces Niveau d'accès de l'administrateur
 * @property DateTime $derniereConnexion Date de la dernière connexion de l'administrateur
 */
class Admin extends Utilisateur
{
    private int $niveauAcces;
    private DateTime $derniereConnexion;

    /**
     * Constructeur de la classe Admin.
     * 
     * @param int|null $id
     * @param string $nom
     * @param string $email
     * @param string $motDePasse
     * @param DateTime $dateInscription
     * @param array $roles
     * @param int $niveauAcces
     * @param DateTime $derniereConnexion
     * @throws InvalidArgumentException
     */
    public function __construct(string $prenom, string $nom, string $email, string $motDePasse, DateTime $dateInscription, int $niveauAcces, DateTime $derniereConnexion)
    {
        parent::__construct($prenom, $nom, $email, $motDePasse, $dateInscription, ['ROLE_ADMIN']);
        $this->niveauAcces = $niveauAcces;
        $this->derniereConnexion = $derniereConnexion;
    }

    /**
     * Retourne le niveau d'accès de l'administrateur.
     * 
     * @return int
     */
    public function getNiveauAcces(): int
    {
        return $this->niveauAcces;
    }

    /**
     * Définit le niveau d'accès de l'administrateur.
     * 
     * @param int $niveauAcces
     */
    public function setNiveauAcces(int $niveauAcces): void
    {
        $this->niveauAcces = $niveauAcces;
    }

    /**
     * Retourne la date de la dernière connexion de l'administrateur.
     * 
     * @return DateTime
     */
    public function getDerniereConnexion(): DateTime
    {
        return $this->derniereConnexion;
    }

    /**
     * Définit la date de la dernière connexion de l'administrateur.
     * 
     * @param DateTime $derniereConnexion
     */
    public function setDerniereConnexion(DateTime $derniereConnexion): void
    {
        $this->derniereConnexion = $derniereConnexion;
    }

    /**
     * Permet de gérer les utilisateurs du système (ajout, modification, suppression).
     * (Méthode vide pour l'instant)
     * 
     * @return void
     */
    public function gererUtilisateurs(): void
    {
        // Méthode vide pour l'instant
    }

    /**
     * Accéder aux logs du système pour les analyses d'audit.
     * (Méthode vide pour l'instant)
     * 
     * @return array
     */
    public function accederJournalSysteme(): array
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