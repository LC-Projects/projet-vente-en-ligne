<?php
declare(strict_types=1);
namespace App\Entity\Produit;

use InvalidArgumentException;

/**
 * Classe représentant un produit numérique
 */
class ProduitNumerique extends Produit
{
    private string $lienTelechargement;
    private float $tailleFichier;
    private string $formatFichier;

    /**
     * Constructeur de la classe ProduitNumerique.
     * 
     * @param string $nom
     * @param float $prix
     * @param string $description
     * @param int $stock
     * @param string $lienTelechargement
     * @param float $tailleFichier
     * @param string $formatFichier
     * @throws InvalidArgumentException
     */
    public function __construct(string $nom, float $prix, string $description, int $stock, string $lienTelechargement, float $tailleFichier, string $formatFichier)
    {
        parent::__construct($nom, $prix, $description, $stock);
        $this->setLienTelechargement($lienTelechargement);
        $this->setTailleFichier($tailleFichier);
        $this->setFormatFichier($formatFichier);
    }

    /**
     * Définit le lien de téléchargement du produit.
     * 
     * @param string $lienTelechargement
     * @throws InvalidArgumentException
     * @return void
     */
    public function setLienTelechargement(string $lienTelechargement): void
    {
        if (empty($lienTelechargement)) {
            throw new InvalidArgumentException("Le lien de téléchargement ne peut pas être vide.");
        } elseif (strlen($lienTelechargement) > 255) {
            throw new InvalidArgumentException("Le lien de téléchargement ne peut pas dépasser 255 caractères.");
        }
        $this->lienTelechargement = $lienTelechargement;
    }

    /**
     * Retourne le lien de téléchargement du produit.
     * 
     * @return string
     */
    public function getLienTelechargement(): string
    {
        return $this->lienTelechargement;
    }

    /**
     * Définit la taille du fichier du produit.
     * 
     * @param float $tailleFichier
     * @throws InvalidArgumentException
     * @return void
     */
    public function setTailleFichier(float $tailleFichier): void
    {
        if ($tailleFichier <= 0) {
            throw new InvalidArgumentException("La taille du fichier doit être supérieure à 0.");
        }
        $this->tailleFichier = $tailleFichier;
    }

    /**
     * Retourne la taille du fichier du produit.
     * 
     * @return float
     */
    public function getTailleFichier(): float
    {
        return $this->tailleFichier;
    }

    /**
     * Définit le format du fichier du produit.
     * 
     * @param string $formatFichier
     * @throws InvalidArgumentException
     * @return void
     */
    public function setFormatFichier(string $formatFichier): void
    {
        if (empty($formatFichier)) {
            throw new InvalidArgumentException("Le format du fichier ne peut pas être vide.");
        } elseif (strlen($formatFichier) > 10) {
            throw new InvalidArgumentException("Le format du fichier ne peut pas dépasser 10 caractères.");
        }
        $this->formatFichier = $formatFichier;
    }

    /**
     * Retourne le format du fichier du produit.
     * 
     * @return string
     */
    public function getFormatFichier(): string
    {
        return $this->formatFichier;
    }

    /**
     * Génère et retourne un lien de téléchargement unique pour le produit.
     * 
     * @return string
     */
    public function genererLienTelechargement(): string
    {
        return $this->lienTelechargement . '?token=' . bin2hex(random_bytes(16));
    }

    /**
     * Calcule les frais de livraison du produit.
     * 
     * @return float
     */
    public function calculerFraisLivraison(): float
    {
        return 0.0;
    }

    /**
     * Affiche les détails du produit.
     * 
     * @return void
     */
    public function afficherDetails(): void
    {
        echo "Nom: " . $this->getNom() . "\n";
        echo "Prix: " . $this->getPrix() . "\n";
        echo "Description: " . $this->getDescription() . "\n";
        echo "Stock: " . $this->getStock() . "\n";
        echo "Lien de téléchargement: " . $this->lienTelechargement . "\n";
        echo "Taille du fichier: " . $this->tailleFichier . " MB\n";
        echo "Format du fichier: " . $this->formatFichier . "\n";
    }
}
?>