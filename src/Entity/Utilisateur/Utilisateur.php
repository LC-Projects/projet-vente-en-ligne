<?php
declare(strict_types=1);

namespace App\Entity\Utilisateur;

use DateTime;
use InvalidArgumentException;

/**
 * Classe abstraite représentant un utilisateur
 * 
 * @property int|null $id Identifiant de l'utilisateur
 * @property string $nom Nom de l'utilisateur
 * @property string $email Adresse email de l'utilisateur
 * @property string $motDePasse Mot de passe de l'utilisateur
 * @property DateTime $dateInscription Date d'inscription de l'utilisateur
 * @property array $roles Rôles de l'utilisateur
 */
abstract class Utilisateur
{
    protected ?int $id;
    protected string $prenom;
    protected string $nom;
    protected string $email;
    protected string $motDePasse;
    protected DateTime $dateInscription;
    protected array $roles;

    /**
     * Constructeur de la classe Utilisateur.
     * 
     * @param int|null $id
     * @param string $nom
     * @param string $email
     * @param string $motDePasse
     * @param DateTime $dateInscription
     * @param array $roles
     * @throws InvalidArgumentException
     */
    public function __construct(string $prenom, string $nom, string $email, string $motDePasse, DateTime $dateInscription, array $roles)
    {
        $this->setPrenom($prenom);
        $this->setNom($nom);
        $this->setEmail($email);
        $this->setMotDePasse($motDePasse);
        $this->dateInscription = $dateInscription;
        $this->roles = $roles;
    }

    /**
     * Retourne l'ID de l'utilisateur.
     * 
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Définit l'ID de l'utilisateur.
     * 
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Retourne le prénom de l'utilisateur.
     * 
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Définit le prénom de l'utilisateur.
     * 
     * @param string $prenom
     * @throws InvalidArgumentException
     */
    public function setPrenom(string $prenom): void
    {
        if (empty($prenom)) {
            throw new InvalidArgumentException("Le prénom ne doit pas être vide.");
        }
        $this->prenom = $prenom;
    }

    /**
     * Retourne le nom de l'utilisateur.
     * 
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Définit le nom de l'utilisateur.
     * 
     * @param string $nom
     * @throws InvalidArgumentException
     */
    public function setNom(string $nom): void
    {
        if (empty($nom)) {
            throw new InvalidArgumentException("Le nom ne doit pas être vide.");
        }
        $this->nom = $nom;
    }

    /**
     * Retourne l'email de l'utilisateur.
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Définit l'email de l'utilisateur.
     * 
     * @param string $email
     * @throws InvalidArgumentException
     */
    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("L'adresse email n'est pas valide.");
        }
        $this->email = $email;
    }

    /**
     * Retourne le mot de passe de l'utilisateur.
     * 
     * @return string
     */
    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    /**
     * Définit le mot de passe de l'utilisateur.
     * 
     * @param string $motDePasse
     * @throws InvalidArgumentException
     */
    public function setMotDePasse(string $motDePasse): void
    {
        if (strlen($motDePasse) < 8) {
            throw new InvalidArgumentException("Le mot de passe doit contenir au moins 8 caractères.");
        }
        $this->motDePasse = $motDePasse;
    }

    /**
     * Retourne la date d'inscription de l'utilisateur.
     * 
     * @return DateTime
     */
    public function getDateInscription(): DateTime
    {
        return $this->dateInscription;
    }

    /**
     * Vérifie si le mot de passe fourni correspond au mot de passe de l'utilisateur.
     * 
     * @param string $motDePasse
     * @return bool
     */
    public function verifierMotDePasse(string $motDePasse): bool
    {
        return password_verify($motDePasse, $this->motDePasse);
    }

    /**
     * Met à jour le profil de l'utilisateur.
     * 
     * @param string $nom
     * @param string $email
     * @param string $motDePasse
     * @throws InvalidArgumentException
     */
    public function mettreAJourProfil(string $nom, string $email, string $motDePasse): void
    {
        $this->setNom($nom);
        $this->setEmail($email);
        $this->setMotDePasse(password_hash($motDePasse, PASSWORD_DEFAULT));
    }

    /**
     * Méthode abstraite pour afficher les rôles de l'utilisateur.
     * 
     * @return string
     */
    abstract public function afficherRoles(): string;
}
?>