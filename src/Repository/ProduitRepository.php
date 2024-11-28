<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Entity\Produit\Produit;
use App\Entity\Produit\ProduitNumerique;
use App\Entity\Produit\ProduitPerissable;
use App\Entity\Produit\ProduitPhysique;
use App\Factory\ProduitFactory;
use Exception;
use InvalidArgumentException;
use PDO;
use PDOException;

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
        try {
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
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Read a product.
     * 
     * @param int $id
     * @return Produit|ProduitNumerique|ProduitPhysique|ProduitPerissable
     */
    public function read(int $id): Produit | ProduitNumerique | ProduitPhysique | ProduitPerissable | null
    {
        try {
            $sql = "SELECT * FROM Produit WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $produit = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$produit) {
                return null;
            }

            $produitEntity = new ProduitFactory;
            $produitEntity = $produitEntity->creerProduit($produit['type'], [
                'nom' => (string) $produit['nom'],
                'prix' => (float) $produit['prix'],
                'description' => (string) $produit['description'],
                'stock' => (int) $produit['stock'],
                'poids' => (float) $produit['poids'],
                'longueur' => (float) $produit['longueur'],
                'largeur' => (float) $produit['largeur'],
                'hauteur' => (float) $produit['hauteur'],
                'lienTelechargement' => $produit['lienTelechargement'],
                'tailleFichier' => (float) $produit['tailleFichier'],
                'formatFichier' => (string) $produit['formatFichier'],
                'dateExpiration' => $produit['dateExpiration'],
                'temperatureStockage' => (float) $produit['temperatureStockage']
            ]);

            $produitEntity->setId($produit['id']);

            return $produitEntity;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update a product.
     * 
     * @param ProduitPhysique|ProduitNumerique|ProduitPerissable $produit
     */
    public function update(ProduitPhysique | ProduitNumerique | ProduitPerissable $produit): void
    {
        try {
            switch (($produit)::class) {
                case $produit instanceof ProduitPhysique:
                    $sql = "UPDATE produit SET 
                            nom = :nom, 
                            description = :description, 
                            prix = :prix, 
                            stock = :stock, 
                            type = :type, 
                            poids = :poids, 
                            longueur = :longueur, 
                            largeur = :largeur, 
                            hauteur = :hauteur 
                        WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $produit->getId(),
                        ':nom' => $produit->getNom(),
                        ':description' => $produit->getDescription(),
                        ':prix' => $produit->getPrix(),
                        ':stock' => $produit->getStock(),
                        ':type' => 'physique',
                        ':poids' => $produit->getPoids(),
                        ':longueur' => $produit->getLongueur(),
                        ':largeur' => $produit->getLargeur(),
                        ':hauteur' => $produit->getHauteur()
                    ]);
                    break;
                case $produit instanceof ProduitNumerique:
                    $sql = "UPDATE produit SET 
                            nom = :nom, 
                            description = :description, 
                            prix = :prix, 
                            stock = :stock, 
                            type = :type, 
                            lienTelechargement = :lienTelechargement, 
                            tailleFichier = :tailleFichier, 
                            formatFichier = :formatFichier 
                        WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $produit->getId(),
                        ':nom' => $produit->getNom(),
                        ':description' => $produit->getDescription(),
                        ':prix' => $produit->getPrix(),
                        ':stock' => $produit->getStock(),
                        ':type' => 'numerique',
                        ':lienTelechargement' => $produit->getLienTelechargement(),
                        ':tailleFichier' => $produit->getTailleFichier(),
                        ':formatFichier' => $produit->getFormatFichier()
                    ]);
                    break;
                case $produit instanceof ProduitPerissable:
                    $sql = "UPDATE produit SET 
                            nom = :nom, 
                            description = :description, 
                            prix = :prix, 
                            stock = :stock, 
                            type = :type, 
                            dateExpiration = :dateExpiration, 
                            temperatureStockage = :temperatureStockage 
                        WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ':id' => $produit->getId(),
                        ':nom' => $produit->getNom(),
                        ':description' => $produit->getDescription(),
                        ':prix' => $produit->getPrix(),
                        ':stock' => $produit->getStock(),
                        ':type' => 'perissable',
                        ':dateExpiration' => $produit->getDateExpiration(),
                        ':temperatureStockage' => $produit->getTemperatureStockage()
                    ]);
                    break;
                default:
                    throw new InvalidArgumentException("Type de produit inconnu");
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete a product.
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        try {
            $sql = "DELETE FROM produit WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Find all products.
     * 
     * @return array
     */
    public function findAll(): array
    {
        try {
            $sql = "SELECT * FROM produit";
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
            $sql = "SELECT * FROM produit";
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
