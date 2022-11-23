<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Formulaire de médecin</h1>
            <p class="text text-center">
                Formulaire permettant d'afficher toutes les informations
                à propos d'un médecin en particulier.
            </p>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5">
                <img class="img-fluid size-img-page" src="assets/img/medecin.jpg">
            </div>
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
                <?php if ($_SESSION['erreur']) {
                    echo '<p class="alert alert-danger text-center w-100">Un problème est survenu lors de la selection du praticien</p>';
                    $_SESSION['erreur'] = false;
                } ?>
                <form action="index.php?uc=medecin&action=gerermedecin" method="post" class="formulaire-recherche col-12 m-0">
                    <label class="titre-formulaire" for="listemedoc">Liste médecin :</label>
                    <select required name="medecin" class="form-select mt-3">
                        <option value class="text-center">- Choisissez un médecin -</option>
                        <?php
                        foreach ($result as $key) {
                        ?>
                            <option value="<?= $key['PRA_NUM'] ?> " class="form-control"><?= $key['PRA_NOM'] . ' ' . $key['PRA_PRENOM'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input class="btn btn-info text-light valider" type="submit" name="gerer" value="Gérer le médecin">
                    <br><br>
                    <label class="titre-formulaire" for="creer">Autre :</label>
                    <a 
                        id="creer" 
                        class="btn btn-success text-light mt-2" 
                        role="button" 
                        aria-pressed="true" 
                        href="index.php?uc=medecin&action=creerMedecin">
                        Créer Medecin
                    </a>
                </form>
            </div>
        </div>
    </div>
</section>