<?php
declare(strict_types=1);
namespace App\Entity\Produit;

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
        $this->lienTelechargement = $lienTelechargement;
        $this->tailleFichier = $tailleFichier;
        $this->formatFichier = $formatFichier;
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