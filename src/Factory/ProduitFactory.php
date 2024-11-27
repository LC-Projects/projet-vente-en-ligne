<?php

declare(strict_types=1);

namespace App\Factory;
use App\Entity\Produit\Produit;
use App\Entity\Produit\ProduitNumerique;
use App\Entity\Produit\ProduitPerissable;
use App\Entity\Produit\ProduitPhysique;
use DateTime;
use InvalidArgumentException;

/**
 * Classe ProduitFactory
 */
class ProduitFactory
{
    /**
     * Crée un produit en fonction du type et des données passées en paramètre.
     * 
     * @param string $type
     * @param array $data
     * @return Produit | ProduitNumerique | ProduitPhysique | ProduitPerissable
     * @throws InvalidArgumentException
     */
    public function creerProduit(string $type, array $data): ProduitNumerique | ProduitPhysique | ProduitPerissable
    {
        switch ($type) {
            case "numerique":
                $this->validateNumeriqueData($data);
                return new ProduitNumerique(
                    $data['nom'],
                    $data['prix'],
                    $data['description'],
                    $data['stock'],
                    $data['lienTelechargement'],
                    $data['tailleFichier'],
                    $data['formatFichier']
                );
            case "physique":
                $this->validatePhysiqueData($data);
                return new ProduitPhysique(
                    $data['nom'],
                    $data['prix'],
                    $data['description'],
                    $data['stock'],
                    $data['poids'],
                    $data['longueur'],
                    $data['largeur'],
                    $data['hauteur']
                );
            case "perissable":
                $this->validatePerissableData($data);
                return new ProduitPerissable(
                    $data['nom'],
                    $data['prix'],
                    $data['description'],
                    $data['stock'],
                    $data['dateExpiration'],
                    $data['temperatureStockage']
                );
            default:
                throw new InvalidArgumentException("Type de produit inconnu");
        }
    }

    /**
     * Valide les données pour un produit numérique.
     * 
     * @param array $data
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateNumeriqueData(array $data): void
    {
        if (
            !is_string($data['nom']) || 
            !is_float($data['prix']) || 
            !is_string($data['description']) || 
            !is_int($data['stock']) || 
            !is_string($data['lienTelechargement']) || 
            !is_float($data['tailleFichier']) || 
            !is_string($data['formatFichier'])
        ) {
            throw new InvalidArgumentException("Invalid data for ProduitNumerique");
        }
    }

    /**
     * Valide les données pour un produit physique.
     * 
     * @param array $data
     * @return void
     * @throws InvalidArgumentException
     */
    private function validatePhysiqueData(array $data): void
    {
        if (
            !is_string($data['nom']) || 
            !is_float($data['prix']) || 
            !is_string($data['description']) || 
            !is_int($data['stock']) || 
            !is_float($data['poids']) || 
            !is_float($data['longueur']) || 
            !is_float($data['largeur']) || 
            !is_float($data['hauteur'])
        ) {
            throw new InvalidArgumentException("Invalid data for ProduitPhysique");
        }
    }

    /**
     * Valide les données pour un produit périssable.
     * 
     * @param array $data
     * @return void
     * @throws InvalidArgumentException
     */
    private function validatePerissableData(array $data): void
    {
        if (
            !is_string($data['nom']) || 
            !is_float($data['prix']) || 
            !is_string($data['description']) || 
            !is_int($data['stock']) || 
            !($data['dateExpiration'] instanceof DateTime) || 
            !is_float($data['temperatureStockage'])
        ) {
            throw new InvalidArgumentException("Invalid data for ProduitPerissable");
        }
    }
}
