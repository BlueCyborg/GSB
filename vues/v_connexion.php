<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Formulaire de connexion</h1>
            <p class="text text-center">Formulaire permettant de se connecter au site et d'accèder au données.</p>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5">
                <img class="img-fluid" src="assets/img/login.png">
            </div>
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
                <?php if (isset($userEmpty)) {
                    ?>
                    <p class="alert alert-danger text-center w-100"><?= htmlspecialchars($userEmpty) ?></p>
                    <?php
                } ?>
                <form class="form-signin formulaire m-auto" action="index.php?uc=connexion&action=connexion" method="post">
                    <h2 class="form-signin-heading">Se connecter</h2>
                    <input type="text" class="form-control" name="username" placeholder="Identifiant" autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" />
                    <input class="btn btn-lg btn-info btn-block text-light" type="submit" name="connexion" value="Connexion">
                </form>
            </div>
        </div>
    </div>
</section>