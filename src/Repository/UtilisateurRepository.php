<?php
declare(strict_types=1);

namespace App\Repository;

use PDO;
use App\Entity\Utilisateur\Utilisateur;

class UtilisateurRepository {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(array $utilisateur): void {
        $sql = "INSERT INTO utilisateur (
                    nom, email, motDePasse, dateInscription, type, 
                    adresseLivraison, boutique, commission, niveauAcces, derniereConnexion
                ) VALUES (
                    :nom, :email, :motDePasse, :dateInscription, :type, 
                    :adresseLivraison, :boutique, :commission, :niveauAcces, :derniereConnexion
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $utilisateur['nom'],
            ':email' => $utilisateur['email'],
            ':motDePasse' => $utilisateur['motDePasse'],
            ':dateInscription' => $utilisateur['dateInscription'] ?? null,
            ':type' => $utilisateur['type'] ?? 'client',
            ':adresseLivraison' => $utilisateur['adresseLivraison'] ?? null,
            ':boutique' => $utilisateur['boutique'] ?? null,
            ':commission' => $utilisateur['commission'] ?? null,
            ':niveauAcces' => $utilisateur['niveauAcces'] ?? null,
            ':derniereConnexion' => $utilisateur['derniereConnexion'] ?? null
        ]);
    }

    public function read(int $id): array {
        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(Utilisateur $utilisateur): void {
        $sql = "UPDATE utilisateur SET 
                    nom = :nom, 
                    email = :email, 
                    motDePasse = :motDePasse, 
                    dateInscription = :dateInscription, 
                    type = :type, 
                    adresseLivraison = :adresseLivraison, 
                    boutique = :boutique, 
                    commission = :commission, 
                    niveauAcces = :niveauAcces, 
                    derniereConnexion = :derniereConnexion 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $utilisateur['id'],
            ':nom' => $utilisateur['nom'],
            ':email' => $utilisateur['email'],
            ':motDePasse' => $utilisateur['motDePasse'],
            ':dateInscription' => $utilisateur['dateInscription'] ?? null,
            ':type' => $utilisateur['type'] ?? 'client',
            ':adresseLivraison' => $utilisateur['adresseLivraison'] ?? null,
            ':boutique' => $utilisateur['boutique'] ?? null,
            ':commission' => $utilisateur['commission'] ?? null,
            ':niveauAcces' => $utilisateur['niveauAcces'] ?? null,
            ':derniereConnexion' => $utilisateur['derniereConnexion'] ?? null
        ]);
    }

    public function delete(int $id): void {
        $sql = "DELETE FROM utilisateur WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}