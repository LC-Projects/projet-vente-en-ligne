<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Entity\Produit\Produit;
use PDO;

/**
 * Class ProduitRepository
 * 
 * Repository class for the Produit entity.
 */
class ProduitRepository
{
    private $pdo;

    /**
     * Constructeur de la classe ProduitRepository.
     */
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance()->connect();
    }

    /**
     * Create a product.
     * 
     * @param array $produit
     */
    public function create(array $produit): void
    {
        $sql = "INSERT INTO produit (
                    nom, description, prix, stock, type, 
                    poids, longueur, largeur, hauteur, 
                    lienTelechargement, tailleFichier, formatFichier, 
                    dateExpiration, temperatureStockage, categorie_id
                ) VALUES (
                    :nom, :description, :prix, :stock, :type, 
                    :poids, :longueur, :largeur, :hauteur, 
                    :lienTelechargement, :tailleFichier, :formatFichier, 
                    :dateExpiration, :temperatureStockage, :categorie_id
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $produit['nom'],
            ':description' => $produit['description'] ?? null,
            ':prix' => $produit['prix'],
            ':stock' => $produit['stock'],
            ':type' => $produit['type'],
            ':poids' => $produit['poids'] ?? null,
            ':longueur' => $produit['longueur'] ?? null,
            ':largeur' => $produit['largeur'] ?? null,
            ':hauteur' => $produit['hauteur'] ?? null,
            ':lienTelechargement' => $produit['lienTelechargement'] ?? null,
            ':tailleFichier' => $produit['tailleFichier'] ?? null,
            ':formatFichier' => $produit['formatFichier'] ?? null,
            ':dateExpiration' => $produit['dateExpiration'] ?? null,
            ':temperatureStockage' => $produit['temperatureStockage'] ?? null,
            ':categorie_id' => $produit['categorie_id'] ?? null,
        ]);
    }

    /**
     * Read a product.
     * 
     * @param int $id
     * @return array
     */
    public function read(int $id): array
    {
        $sql = "SELECT * FROM produit WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update a product.
     * 
     * @param Produit $produit
     */
    public function update(Produit $produit): void
    {
        $sql = "UPDATE produit SET 
                    nom = :nom, 
                    description = :description, 
                    prix = :prix, 
                    stock = :stock, 
                    type = :type, 
                    poids = :poids, 
                    longueur = :longueur, 
                    largeur = :largeur, 
                    hauteur = :hauteur, 
                    lienTelechargement = :lienTelechargement, 
                    tailleFichier = :tailleFichier, 
                    formatFichier = :formatFichier, 
                    dateExpiration = :dateExpiration, 
                    temperatureStockage = :temperatureStockage, 
                    categorie_id = :categorie_id 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $produit['id'],
            ':nom' => $produit['nom'],
            ':description' => $produit['description'] ?? null,
            ':prix' => $produit['prix'],
            ':stock' => $produit['stock'],
            ':type' => $produit['type'],
            ':poids' => $produit['poids'] ?? null,
            ':longueur' => $produit['longueur'] ?? null,
            ':largeur' => $produit['largeur'] ?? null,
            ':hauteur' => $produit['hauteur'] ?? null,
            ':lienTelechargement' => $produit['lienTelechargement'] ?? null,
            ':tailleFichier' => $produit['tailleFichier'] ?? null,
            ':formatFichier' => $produit['formatFichier'] ?? null,
            ':dateExpiration' => $produit['dateExpiration'] ?? null,
            ':temperatureStockage' => $produit['temperatureStockage'] ?? null,
            ':categorie_id' => $produit['categorie_id'] ?? null,
        ]);
    }

    /**
     * Delete a product.
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM produit WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    /**
     * Find all products.
     * 
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM produit";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find products by criteria.
     * 
     * @param array $criteria
     * @return array
     */
    public function findBy(array $criteria): array
    {
        $sql = "SELECT * FROM produit WHERE ";
        $sql .= implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($criteria)));
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($criteria);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
