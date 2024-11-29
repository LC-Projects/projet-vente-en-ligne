<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;

class ProduitController
{
    const ROOT = __DIR__ . '/../../';
    private $produitRepository;
    private $CategorieRepository;

    public function __construct()
    {
        $this->produitRepository = new ProduitRepository();
        $this->CategorieRepository = new CategorieRepository();
    }

    public function afficherListeProduits()
    {
        $produits = $this->produitRepository->findAll();
        $categories = $this->CategorieRepository->findAll();
        include self::ROOT . 'src/View/Produits/list.php';
    }

    public function afficherProduit($id)
    {
        $produit = $this->produitRepository->findBy(['search' => ['id' => $id]])[0];
        include self::ROOT . 'src/View/Produits/detail.php';
    }
}