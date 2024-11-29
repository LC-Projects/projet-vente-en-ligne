<?php include_once __DIR__.'/../header.php'; ?>
<h1>Liste des produits</h1>
<div class="container">
	<div class="row d-flex justify-content-center">
	<?php foreach ($produits as $produit) : ?>
		<div class="card" style="width: 18rem;">
			<img src="..." class="card-img-top" alt="...">
			<div class="card-body">
				<h5 class="card-title"><?= $produit['nom'] ?></h5>
				<p class="card-text"><?= $produit['prix'] ?> €</p>
				<a class="btn btn-primary" href="/produit?id=<?= $produit['id'] ?>">Voir</a>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	
</div>

<?php include_once __DIR__.'/../footer.php'; ?>