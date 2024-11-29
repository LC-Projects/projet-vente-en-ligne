<!DOCTYPE html>
<html>
<head>
    <title>Liste des Produits</title>
</head>
<body>
    <h1>Liste des Produits</h1>
    <ul>
        <?php foreach ($produits as $produit): ?>
            <li><?= $produit['nom']; ?> - <?= $produit['prix']?> €</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>