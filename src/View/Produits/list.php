<?php include_once __DIR__.'/../header.php'; ?>

    

    <section style="background-image: url('assets/banner.jpg');background-repeat: no-repeat;background-size: cover;">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-6 pt-5 mt-5">
                    <h2 class="display-1 ls-1">
                        <span class="fw-bold text-primary">VET</span>
                        Tout vos produits en
                        <span class="fw-bold">un clic</span>
                    </h2>
                    <p class="fs-4">
                        Vente en ligne de produits alimentaires et non alimentaires
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-primary text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">
                            Commandez maintenant
                        </a>
                        <a href="#" class="btn btn-dark text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">
                            Rejoingnez-nous
                        </a>
                    </div>
                    <div class="row my-5">
                        <div class="col">
                            <div class="row text-dark">
                                <div class="col-auto">
                                    <p class="fs-1 fw-bold lh-sm mb-0">14k+</p>
                                </div>
                                <div class="col">
                                    <p class="text-uppercase lh-sm mb-0">
                                        Variétés produits
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row text-dark">
                                <div class="col-auto">
                                    <p class="fs-1 fw-bold lh-sm mb-0">50k+</p>
                                </div>
                                <div class="col">
                                    <p class="text-uppercase lh-sm mb-0">
                                        Clients satisfaits
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row text-dark">
                                <div class="col-auto">
                                    <p class="fs-1 fw-bold lh-sm mb-0">10+</p>
                                </div>
                                <div class="col">
                                    <p class="text-uppercase lh-sm mb-0">
                                        Magasins physique
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-0 justify-content-center">
                <div class="col">
                    <div class="card border-0 bg-primary rounded-0 p-4 text-light">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <svg width="60" height="60">
                                    <use xlink:href="#fresh"></use>
                                </svg>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body p-0">
                                    <h5 class="text-light">
                                        Frais de la ferme
                                    </h5>
                                    <p class="card-text">
                                        Producteurs locaux
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 bg-secondary rounded-0 p-4 text-light">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <svg width="60" height="60">
                                    <use xlink:href="#organic"></use>
                                </svg>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body p-0">
                                    <h5 class="text-light">
                                        100% Bio
                                    </h5>
                                    <p class="card-text">
                                        Produits naturels et sans additifs
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 bg-danger rounded-0 p-4 text-light">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <svg width="60" height="60">
                                    <use xlink:href="#delivery"></use>
                                </svg>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body p-0">
                                    <h5 class="text-light">
                                        Livraison gratuite
                                    </h5>
                                    <p class="card-text">
                                        Livraison jusqu'à votre porte
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Category -->
    <section class="py-5 overflow-hidden">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                        <h2 class="section-title">
                            Catégories
                        </h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary me-2">
                                Voir tout
                            </a>
                            <div class="swiper-buttons">
                                <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                                <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="category-carousel swiper">
                        <div class="swiper-wrapper">

                            <!-- TODO: Catégories : Foreach -->
							
							<?php foreach ($categories as $categorie) : ?>
								<a href="#" class="nav-link swiper-slide text-center">
									<img src="images/category-thumb-1.jpg" class="rounded-circle" alt="Category Thumbnail">
									<h4 class="fs-6 mt-3 fw-normal category-title"><?= $categorie['nom'] ?></h4>
								</a>
							<?php endforeach ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <!-- Best Selling -->
    <section class="pb-5">
        <div class="container-lg">

            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between my-4">

                        <h2 class="section-title">
                            Nos produits
                        </h2>

                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary rounded-1">
                                Voir tout
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div
                        class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">

                        <!-- TODO: Produits : Foreach -->
                        <?php foreach ($produits as $produit) : ?>
							<div class="col">
                            <div class="product-item">
                                <figure>
                                    <a href="/produit?id=<?= $produit['id'] ?>" title="Product Title">
                                        <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/05856ac7-0129-4395-bd6e-2fe2669025fb/custom-nike-dunk-low-by-you-su24.png" alt="Product Thumbnail" class="tab-image" width="240px">
                                    </a>
                                </figure>
                                <div class="d-flex flex-column text-center">
                                    <h3 class="fs-6 fw-normal"><?= $produit['nom'] ?></h3>
                                    <div>
                                        <span class="rating">
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-full"></use>
                                            </svg>
                                            <svg width="18" height="18" class="text-warning">
                                                <use xlink:href="#star-half"></use>
                                            </svg>
                                        </span>
                                        <span>(222)</span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <del>$<?= ((int) $produit['prix']) + 10 ?></del>
                                        <span class="text-dark fw-semibold">$<?= $produit['prix'] ?></span>
                                        <span
                                            class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                            OFF</span>
                                    </div>
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3"><input type="number" name="quantity"
                                                    class="form-control border-dark-subtle input-number quantity"
                                                    value="1"></div>
                                            <div class="col-7"><a href="#"
                                                    class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg width="18"
                                                        height="18">
                                                        <use xlink:href="#cart"></use>
                                                    </svg> Add to Cart</a></div>
                                            <div class="col-2"><a href="#"
                                                    class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg width="18"
                                                        height="18">
                                                        <use xlink:href="#heart"></use>
                                                    </svg></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php endforeach ?>
                    </div>
                    <!-- / product-grid -->


                </div>
            </div>
        </div>
    </section>


    <!-- Newsletter -->
    <section>
        <div class="container-lg">

            <div class="bg-secondary text-light py-5 my-5"
                style="background: url('assets/banner-newsletter.jpg') no-repeat; background-size: cover;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 p-3">
                            <div class="section-header">
                                <h2 class="section-title display-5 text-light">
                                    Recevez -10% sur votre première commande
                                </h2>
                            </div>
                            <p>
                                Inscrivez-vous à notre newsletter
                            </p>
                        </div>
                        <div class="col-md-5 p-3">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label d-none">Nom</label>
                                    <input type="text" class="form-control form-control-md rounded-0" name="name"
                                        id="name" placeholder="Nom">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label d-none">Email</label>
                                    <input type="email" class="form-control form-control-md rounded-0" name="email"
                                        id="email" placeholder="Email Address">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-dark btn-md rounded-0">
                                        S'inscrire
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- Appli -->
    <section class="pb-4 my-4">
        <div class="container-lg">

            <div class="bg-warning pt-5 rounded-5">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4">
                            <h2 class="mt-5">
                                Téléchargez notre application
                            </h2>
                            <p>
                                Shopping en ligne plus facile et plus rapide avec notre application
                            </p>
                            <div class="d-flex gap-2 flex-wrap mb-5">
                                <a href="#" title="App store"><img src="assets/img-app-store.png" alt="app-store"></a>
                                <a href="#" title="Google Play"><img src="assets/img-google-play.png"
                                        alt="google-play"></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <img src="assets/banner-onlineapp.png" alt="phone" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-4">
        <div class="container-lg">
            <h2 class="my-4">
                Les clients ont également cherché
            </h2>
            <a href="#" class="btn btn-warning me-2 mb-2">
                Légumes
            </a>
            <a href="#" class="btn btn-warning me-2 mb-2">
                Fruits
            </a>
            <a href="#" class="btn btn-warning me-2 mb-2">
                Viandes
            </a>
            <a href="#" class="btn btn-warning me-2 mb-2">
                Poissons
            </a>
            <a href="#" class="btn btn-warning me-2 mb-2">
                Produits laitiers
            </a>
        </div>
    </section>

    <section class="py-5">
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#package"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>
                                Livraison gratuite
                            </h5>
                            <p class="card-text">
                                Directement à votre porte
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#secure"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>
                                Paiement sécurisé
                            </h5>
                            <p class="card-text">
                                SSL crypté
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#quality"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>
                                Produits de qualité
                            </h5>
                            <p class="card-text">
                                Bien choisi par nos experts
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#savings"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>
                                Économies garanties
                            </h5>
                            <p class="card-text">
                                Les meilleurs prix
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg width="32" height="32">
                                <use xlink:href="#offers"></use>
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>
                                Offres spéciales
                            </h5>
                            <p class="card-text">
                                Pour les clients fidèles
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include_once __DIR__.'/../footer.php'; ?>