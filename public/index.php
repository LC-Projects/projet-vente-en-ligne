<?php
// Démarrer la session
session_start();

require '../vendor/autoload.php';

use App\Controller\ProduitController;
use App\Controller\UtilisateurController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(empty($_SESSION['utilisateur'])){
    if (('/login' === $uri || '/login/' === $uri) ) {
        $controller = new UtilisateurController();
        $controller->login();
    }elseif (('/register' === $uri || '/register/' === $uri) ) {
        $controller = new UtilisateurController();
        $controller->register();
    }else {
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
    }
}else{
    if ('/' === $uri) {
        $controller = new ProduitController();
        $controller->afficherListeProduits();
    } elseif (('/produit' === $uri || '/produit/' === $uri) && isset($_GET['id'])) {
        $controller = new ProduitController();
        $controller->afficherProduit($_GET['id']);
    } elseif (('/logout' === $uri || '/logout/' === $uri)) {
        $controller = new UtilisateurController();
        $controller->logout();
    }else {
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
    }
}



?>

