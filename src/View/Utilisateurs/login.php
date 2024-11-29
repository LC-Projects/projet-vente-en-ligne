<?php include_once __DIR__.'/../header.php'; ?>
<div class="container">
<h1>Connexion</h1>
<form action="/login" method="post" class="mt-4">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="row d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <h4 class="m-0">Vous n'avez pas de compte ? <a href="/register">Inscrivez-vous</a></h2>
    </div>
    
</form>
</div>
<?php include_once __DIR__.'/../header.php'; ?>
