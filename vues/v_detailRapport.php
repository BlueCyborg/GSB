<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Detail du rapport N°<?= htmlspecialchars($rapNum) ?></h1>
            <p class="text text-center">
                Detail d'un rapport de visite.
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <div class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3 justify-align-content-stretch align-items-stretch">
                <h2 class="titre-formulaire align-self-center">Rapport de visite</h2>
                <div class="d-flex flex-lg-row flex-column justify-content-stretch align-content-stretch gap-5 px-5">
                    <div class="d-flex justify-content-between align-content-start flex-column flex-fill gap-3">
                        <p class="m-0">
                            Numéro du rapport: <span class="text-seconda"><?= htmlspecialchars($rapNum) ?></span>
                        </p>

                        <p class="m-0">
                            Matricule du collaborateur:
                            <span class="text-secondary"><?= htmlspecialchars($colMatricule) ?></span>
                        </p>

                        <p class="m-0">
                            Praticien concerné: <span class="text-primary"><?= htmlspecialchars($unPraticien['PRA_NOM'] . ' ' . $unPraticien['PRA_PRENOM']) ?></span>
                        </p>

                        <?php
                        if (!empty($unRemplacant)) {
                        ?>
                            <p class="m-0">
                                Remplacant concerné: <span class="text-primary"><?= htmlspecialchars($unRemplacant['PRA_NOM'] . ' ' . $unRemplacant['PRA_PRENOM']) ?></span>
                            </p>
                        <?php
                        }
                        ?>

                        <p class="m-0">
                            Date de saisie: <span class="text-primary"><?= htmlspecialchars($saisieDate) ?></span>
                        </p>

                        <p class="m-0">
                            Bilan du rapport:
                            <textarea readonly class="border-2 rounded-2 border-secondary rounded text-primary" rows="4"><?= htmlspecialchars($rapBilan) ?></textarea>
                        </p>
                    </div>
                    <div class="d-flex justify-content-start align-content-start flex-column flex-fill gap-3">
                        <p class="m-0">
                            Date de visite: <span class="text-primary"><?= htmlspecialchars($visiteDate) ?></span>
                        </p>

                        <p class="m-0">
                            Motif: <span class="text-primary"><?= htmlspecialchars(($unMotif['MOT_ID'] != 'OTH') ? $unMotif['MOT_LIB'] : $motifAutre) ?></span>
                        </p>

                        <?php
                        if (!empty($preMed)) {
                        ?>
                            <p class="m-0">
                                1er médicament présenté: <span class="text-primary"><?= htmlspecialchars($preMed['MED_NOMCOMMERCIAL']) ?></span>
                            </p>
                        <?php
                        }
                        ?>

                        <?php
                        if (!empty($secMed)) {
                        ?>
                            <p class="m-0">
                                2eme médicament présenté: <span class="text-primary"><?= htmlspecialchars($secMed['MED_NOMCOMMERCIAL']) ?></span>
                            </p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="justify-content-start align-content-start gap-0 px-5">
                    <?php
                    $nbEch = count($lesEchantillions);
                    if ($nbEch > 0) {
                    ?>
                        <p class="m-0"><?= $nbEch == 1 ? 'L\'échantillion' : 'Les échantillons' ?>:</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Quantité
                                    </th>
                                    <th scope="col">
                                        Médicament
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($lesEchantillions as $ech) { //affichage des echantillions
                                ?>
                                    <tr>
                                        <td>
                                            <?= htmlspecialchars($ech['qte']) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($ech['medName']) ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <p class="m-0">Aucun échantillon</label>
                    <?php
                    }
                    ?>
                </div>
                <hr class="">
                <div class="d-flex flex-row justify-content-center align-content-center gap-3">
                    <a href="index.php?uc=rapport&action=mesRapports" class="btn btn-info text-light" role="button">Retour</a>
                </div>
            </div>
        </div>
    </div>
</section>