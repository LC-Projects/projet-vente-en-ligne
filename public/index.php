<?php

require '../vendor/autoload.php';

use App\Controller\ProduitController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $uri) {
    $controller = new ProduitController();
    $controller->afficherListeProduits();
} elseif ('/produit' === $uri && isset($_GET['id'])) {
    $controller = new ProduitController();
    $controller->afficherProduit($_GET['id']);
} else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}

?>

