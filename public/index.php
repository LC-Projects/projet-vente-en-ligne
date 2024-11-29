<?php

require '../vendor/autoload.php';

use App\Controller\ProduitController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/produits' === $uri) {
    $controller = new ProduitController();
    $controller->afficherListeProduits();
} elseif (preg_match('/^\/produit\/(\d+)$/', $uri, $matches)) {
    $controller = new ProduitController();
    $controller->afficherProduit($matches[1]);
} else {
    echo "404 Not Found";
}

?>