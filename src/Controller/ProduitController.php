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
        $imagesProduitPlaceHolder = [
            "https://media.carrefour.fr/medias/fa5ef13f799f408392fa588a858ce1ee/p_540x540/08003340805306_C1N1_s08.jpeg",
            "https://media.carrefour.fr/medias/cc84fea0dfc530caa833498069632d94/p_540x540/3560071014520-0.jpg",
            "https://media.carrefour.fr/medias/eac51db226553234ba8990ed218556a5/p_200x200/3523680438224-0.jpg",
            "https://media.carrefour.fr/medias/940ba8f99e3f3d448c0959a00cd96e86/p_200x200/05449000132680-h1l1-s01.jpg",
            "https://media.carrefour.fr/medias/69518a4cff9b46958473241c68522f3a/p_200x200/07622202014826_C1N1_s01.jpeg",
            "https://media.carrefour.fr/medias/cd127b43ea24420bb5430539d3b7b48e/p_200x200/03428273140105_C1L1_s05.png",
            "https://media.carrefour.fr/medias/10cc666ba85d4812a607ea4628bbc397/p_200x200/03248830000150_C1N1_s36.jpeg",
            "https://media.carrefour.fr/medias/f170515eeb2c4644b68dc18edc32df58/p_200x200/08712566246526_H1N1_s02.png",
            "https://media.carrefour.fr/medias/a966e94043a246499ab39f357fffafff/p_200x200/08000500426494_C1N1_s02.png",
            "https://media.carrefour.fr/medias/1926605011333a6bac5cba20d6172563/p_200x200/07613037928532-h1n1-s01.jpg"
        ];

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