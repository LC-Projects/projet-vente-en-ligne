<?php

namespace App\Controller;

use App\Repository\ProduitRepository;

class ProduitController
{
    const ROOT = __DIR__ . '/../../';
    private $produitRepository;

    public function __construct()
    {
        $this->produitRepository = new ProduitRepository();
    }

    public function afficherListeProduits()
    {
        $produits = $this->produitRepository->findAll();
        include self::ROOT . 'src/View/Produits/list.php';
    }

    public function afficherProduit($id)
    {
        $produit = $this->produitRepository->findBy(['search' => ['id' => $id]])[0];
        include self::ROOT . 'src/View/Produits/detail.php';
    }
}