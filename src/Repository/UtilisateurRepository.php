<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Entity\Panier;
use App\Entity\Utilisateur\Admin;
use App\Entity\Utilisateur\Client;
use PDO;
use App\Entity\Utilisateur\Utilisateur;
use App\Entity\Utilisateur\Vendeur;
use DateTime;
use Exception;
use PDOException;


/**
 * UtilisateurRepository class.
 */
class UtilisateurRepository
{

    private $pdo;


    /**
     * Constructor of the UtilisateurRepository class.
     */
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance()->connect();
    }


    /**
     * Create a Utilisateur.
     * 
     * @param array $utilisateur
     * @return void
     */
    public function create(array $utilisateur): void
    {
        try {
            $sql = "INSERT INTO utilisateur (
                nom, email, motDePasse, type, 
                adresseLivraison, boutique, commission, niveauAcces, derniereConnexion
            ) VALUES (
                :nom, :email, :motDePasse, :type, 
                :adresseLivraison, :boutique, :commission, :niveauAcces, :derniereConnexion
            )";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nom' => $utilisateur['nom'],
                ':email' => $utilisateur['email'],
                ':motDePasse' => $utilisateur['motDePasse'],
                ':type' => $utilisateur['type'] ?? 'client',
                ':adresseLivraison' => $utilisateur['adresseLivraison'] ?? null,
                ':boutique' => $utilisateur['boutique'] ?? null,
                ':commission' => $utilisateur['commission'] ?? null,
                ':niveauAcces' => $utilisateur['niveauAcces'] ?? null,
                ':derniereConnexion' => $utilisateur['derniereConnexion'] ?? null
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }


    /**
     * Read a Utilisateur.
     * 
     * @param int $id
     * @return Client | Vendeur | Admin | null
     */
    public function read(int $id): Client | Vendeur | Admin | null
    {
        try {
            $sql = "SELECT * FROM utilisateur WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$utilisateur) {
                return null;
            }


            $panier = new Panier(new DateTime('2021-10-01'));

            // type of $utilisateur['dateInscription'],
            echo gettype($utilisateur['dateInscription']);

            $dateInscription = new DateTime($utilisateur['dateInscription']);

            $utilisateurEntity = null;
            switch ($utilisateur['type']) {
                case 'client':
                    $utilisateurEntity = new Client(
                        "prenom",
                        $utilisateur['nom'],
                        $utilisateur['email'],
                        $utilisateur['motDePasse'],
                        $dateInscription,
                        $utilisateur['adresseLivraison'],
                        $panier
                    );
                    break;
                case 'vendeur':
                    $utilisateurEntity = new Vendeur(
                        "prenom",
                        $utilisateur['nom'],
                        $utilisateur['email'],
                        $utilisateur['motDePasse'],
                        $dateInscription,
                        $utilisateur['adresseLivraison'],
                        $utilisateur['boutique'],
                        $utilisateur['commission']
                    );
                    break;
                case 'admin':
                    $utilisateurEntity = new Admin(
                        "prenom",
                        $utilisateur['nom'],
                        $utilisateur['email'],
                        $utilisateur['motDePasse'],
                        $dateInscription,
                        $utilisateur['adresseLivraison'],
                        $utilisateur['niveauAcces'],
                        $utilisateur['derniereConnexion']
                    );
                    break;
                default:
                    throw new Exception("Type d'utilisateur inconnu.");
            }

            $utilisateurEntity->setId($utilisateur['id']);

            return $utilisateurEntity;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * Update a Utilisateur.
     * 
     * @param Client | Vendeur | Admin $utilisateur
     * @return void
     */
    public function update(Client | Vendeur | Admin $utilisateur): void
    {
        try {
            switch (($utilisateur)::class) {
                case $utilisateur instanceof Client:
                    $sql = "UPDATE utilisateur SET 
                        nom = :nom, 
                        email = :email, 
                        motDePasse = :motDePasse, 
                        adresseLivraison = :adresseLivraison
                    WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $utilisateur->getId(),
                        ':nom' => $utilisateur->getNom(),
                        ':email' => $utilisateur->getEmail(),
                        ':motDePasse' => $utilisateur->getMotDePasse(),
                        ':adresseLivraison' => $utilisateur->getAdresseLivraison()
                    ]);
                    break;
                case $utilisateur instanceof Vendeur:
                    $sql = "UPDATE utilisateur SET 
                        nom = :nom, 
                        email = :email, 
                        motDePasse = :motDePasse, 
                        adresseLivraison = :adresseLivraison, 
                        boutique = :boutique, 
                        commission = :commission
                    WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $utilisateur->getId(),
                        ':nom' => $utilisateur->getNom(),
                        ':email' => $utilisateur->getEmail(),
                        ':motDePasse' => $utilisateur->getMotDePasse(),
                        ':boutique' => $utilisateur->getBoutique(),
                        ':commission' => $utilisateur->getCommission()
                    ]);
                    break;
                case $utilisateur instanceof Admin:
                    $sql = "UPDATE utilisateur SET 
                        nom = :nom, 
                        email = :email, 
                        motDePasse = :motDePasse, 
                        niveauAcces = :niveauAcces, 
                        derniereConnexion = :derniereConnexion
                    WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $utilisateur->getId(),
                        ':nom' => $utilisateur->getNom(),
                        ':email' => $utilisateur->getEmail(),
                        ':motDePasse' => $utilisateur->getMotDePasse(),
                        ':niveauAcces' => $utilisateur->getNiveauAcces(),
                        ':derniereConnexion' => $utilisateur->getDerniereConnexion()
                    ]);
                    break;
                default:
                    throw new Exception("Type d'utilisateur inconnu.");
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }


    /**
     * Delete a Utilisateur.
     * 
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            $sql = "DELETE FROM utilisateur WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }


    /**
     * Find all Utilisateurs.
     * 
     * @return array
     */
    public function findAll(): array
    {
        try {
            $sql = "SELECT * FROM utilisateur";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * Find products by criteria.
     * 
     * @param array $criteria
     * @return array
     */
    public function findBy(array $criteria): array
    {
        try {
            // $criteria contain the search criteria, order and limit
            $sql = "SELECT * FROM utilisateur";
            // search criteria
            if (isset($criteria['search'])) {
                $sql .=  " WHERE " . implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($criteria['criteria'])));
            }
            // order
            if (isset($criteria['order'])) {
                $sql .= " ORDER BY " . $criteria['order'];
            }
            // limit
            if (isset($criteria['limit'])) {
                $sql .= " LIMIT " . $criteria['limit'];
            }

            $stmt = $this->pdo->prepare($sql);
            if (isset($criteria['search']))
                $stmt->execute($criteria['search']);
            else
                $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
