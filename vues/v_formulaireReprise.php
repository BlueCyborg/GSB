<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Formulaire de reprise de rapport</h1>
            <p class="text text-center">
                Formulaire permettant d'afficher toutes les rapports
                non validés et d'en crée de nouveau.
            </p>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5">
                <img class="img-fluid size-img-page" src="assets/img/medical_banner_dark.png">
            </div>
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
                <?php if ($_SESSION['erreur']) {
                    echo '<p class="alert alert-danger text-center w-100">Un problème est survenu lors de la selection du praticien</p>';
                    $_SESSION['erreur'] = false;
                } ?>
                <form action="index.php?uc=rapport&action=saisirRapport" method="post" class="formulaire-recherche col-12 m-0">
                    <label class="titre-formulaire" for="rapport">Liste des rapports non validés :</label>
                    <?php
                        if (count($rapportNonValides) <= 0) {
                            ?>
                            <p id="rapport">Aucun rapport en cours</p>
                            <?php
                        } else {//count($rapportNonValides) > 0
                    ?>
                        <select required name="rapNum" id="rapport" class="form-select mt-3">
                            <option value class="text-center">- Choisissez un rapport non validé -</option>
                            <?php
                            foreach ($rapportNonValides as $rapport) {
                            ?>
                                <option value="<?=htmlspecialchars($rapport['RAP_NUM'])?> " class="form-control">
                                    <?=htmlspecialchars(
                                        'N°'.$rapport['RAP_NUM'].
                                        ' du '.date('Y-m-d', strtotime($rapport['RAP_DATE_VISITE'])).
                                        ' - '.$rapport['MOTIF']
                                    );?>
                                </option>
                            <?php    
                            }
                            ?>
                        </select>
                        <input class="btn btn-info text-light" type="submit" value="Reprendre le rapport">
                    <?php
                    }
                    ?>
                    <label class="titre-formulaire mt-3" for="nouveau">Nouveau rapport :</label>
                    <a 
                        id="nouveau" 
                        class="btn btn-success text-light mt-2" 
                        role="button" 
                        aria-pressed="true" 
                        href="index.php?uc=rapport&action=creeRapport">
                        Nouveau rapport
                    </a>
                </form>
            </div>
        </div>
    </div>
</section>
