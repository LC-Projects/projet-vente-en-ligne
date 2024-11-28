<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Entity\Categorie;
use PDO;
use PDOException;
use Exception;

class CategorieRepository
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance()->connect();
    }

    public function create(array $categorie): void
    {
        try {
            $sql = "INSERT INTO categorie (nom, description) VALUES (:nom, :description)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nom' => $categorie['nom'],
                ':description' => $categorie['description'] ?? null
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function read(int $id): Categorie | null
    {
        try {
            $sql = "SELECT * FROM categorie WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $categorieData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$categorieData) {
                return null;
            }

            $categorie = new Categorie(
                $categorieData['nom'],
                $categorieData['description']
            );

            $categorie->setId($categorieData['id']);

            return $categorie;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Categorie $categorie): void
    {
        try {
            $sql = "UPDATE categorie SET nom = :nom, description = :description WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $categorie->getId(),
                ':nom' => $categorie->getNom(),
                ':description' => $categorie->getDescription() ?? null
            ]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function delete(int $id): void
    {
        try {
            $sql = "DELETE FROM categorie WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function findAll(): array
    {
        try {
            $sql = "SELECT * FROM categorie";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function findBy(array $criteria): array
    {
        try {
            $sql = "SELECT * FROM categorie";
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
