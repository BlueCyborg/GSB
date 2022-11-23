<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Saisie du rapport N°<?=htmlspecialchars($rapNum)?></h1>
            <p class="text text-center">
                Formulaire permettant de rédiger un rapport de visite.
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php?uc=rapport&action=saisit" method="post" class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3">
                <div class="flex-fill w-100">
                    <p class="redstar">
                        Champs obligatoires
                    </p>
                </div>
                <h2 class="titre-formulaire">Rapport de visite</h2>
                <div class="d-flex flex-row justify-content-stretch align-content-stretch w-100 gap-5 px-5">
                    <div class="d-flex justify-content-between align-content-star flex-column flex-fill">
                        <label for="rapNum" class="form-label">
                            Numéro du rapport:
                            <span id="rapNum" class="text-secondary"><?=htmlspecialchars($rapNum)?></span>
                        </label>

                        <label for="colMat" class="form-label">
                            Matricule du collaborateur:
                            <span id="colMat" class="text-secondary"><?=htmlspecialchars($colMatricule)?></span>
                        </label>
                        
                        <label for="rapPraID" class="form-label required">Praticien concerné:</label>
                        <select name="rapPraID" id="rapPraID" class="form-select">
                            <?php
                                if (empty($unPraticien)) {
                            ?>
                                <option value class="text-center" selected>- Choisissez un praticien -</option>
                            <?php
                                } else {
                            ?>
                                <option value="<?=htmlspecialchars($unPraticien['PRA_NUM'])?>" class="text-center" selected>
                                    <?=htmlspecialchars($unPraticien['PRA_NOM'].' '.$unPraticien['PRA_PRENOM'])?>
                                </option>
                            <?php
                                }
                            ?>

                            <?php
                            foreach ($lesPraticiens as $praticien) {
                            ?>
                                <option value="<?=htmlspecialchars($praticien['PRA_NUM'])?>" class="form-control">
                                    <?=htmlspecialchars($praticien['PRA_NOM'].' '.$praticien['PRA_PRENOM'])?>
                                </option>
                            <?php    
                            }
                            ?>
                        </select>

                        <label for="saisieDate" class="form-label required">Date de saisie:</label>
                        <input id="saisieDate" name="saisieDate" class="form-control" type="date" value=<?=htmlspecialchars($saisieDate)?>>

                        <label for="rapBilan" class="form-label required">Bilan du rapport:</label>
                        <textarea id="rapBilan" name="rapBilan" class="form-control" rows="4"><?=htmlspecialchars($rapBilan)?></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-content-star flex-column flex-fill">
                        <label for="visiteDate" class="form-label required">Date de visite:</label>
                        <input id="visiteDate" name="visiteDate" class="form-control" type="date" value=<?=htmlspecialchars($visiteDate)?>>
                        
                        <label for="idMotif" class="form-label required">Motif:</label>
                        <select name="idMotif" id="idMotif" class="form-select">
                            <?php
                                if (empty($unMotif)) {
                            ?>
                                <option value class="text-center" selected>- Choisissez un praticien -</option>
                            <?php
                                } else {
                            ?>
                                <option value="<?=htmlspecialchars($unMotif['MOT_ID'])?>" class="text-center" selected>
                                    <?=htmlspecialchars($unMotif['MOT_LIB'])?>
                                </option>
                            <?php
                                }
                            ?>

                            <?php
                            foreach ($lesMotifs as $motifs) {
                            ?>
                                <option value="<?=htmlspecialchars($motif['MOT_ID'])?>" class="text-center" selected>
                                    <?=htmlspecialchars($motif['MOT_LIB'])?>
                                </option>
                            <?php    
                            }
                            ?>
                        </select>

                        <label for="motifAutre" class="form-label required">Autre Motif:</label>
                        <input id="motifAutre" name="motifAutre" class="form-control" type="text" value=<?=htmlspecialchars($motifAutre)?>>
                        
                        <datalist id="lesMeds">
                            <?php
                            foreach ($lesMeds as $med) {
                            ?>
                                <option value="<?=htmlspecialchars($med['MED_DEPOTLEGAL'])?>" class="text-center" selected>
                                    <?=htmlspecialchars($med['MED_DEPOTLEGAL'].' - '.$med['MED_NOMCOMMERCIAL'])?>
                                </option>
                            <?php    
                            }
                            ?>
                        </datalist>

                        <label for="idMed1" class="form-label required">1er médicament présenté</label>
                        <select name="idMotif" id="idMotif" class="form-select" list="lesMeds">
                            <?php
                                if (empty($preMed)) {
                            ?>
                                <option value class="text-center" selected>- Choisissez un praticien -</option>
                            <?php
                                } else {
                            ?>
                                <option value="<?=htmlspecialchars($preMed['MED_DEPOTLEGAL'])?>" class="text-center" selected>
                                    <?=htmlspecialchars($preMed['MED_DEPOTLEGAL'].' - '.$preMed['MED_NOMCOMMERCIAL'])?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                        <label for="idMed2" class="form-label required">2eme médicament présenté</label>
                        <select name="idMotif" id="idMotif" class="form-select" list="lesMeds">
                            <?php
                                if (empty($secMed)) {
                            ?>
                                <option value class="text-center" selected>- Choisissez un praticien -</option>
                            <?php
                                } else {
                            ?>
                                <option value="<?=htmlspecialchars($secMed['MED_DEPOTLEGAL'])?>" class="text-center" selected>
                                    <?=htmlspecialchars($secMed['MED_DEPOTLEGAL'].' - '.$secMed['MED_NOMCOMMERCIAL'])?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="saisieDef" name="saisieDef">
                    <label class="form-check-label" for="saisieDef">Saisie définitive</label>
                </div>
                <div class="d-flex flex-row justify-content-center align-content-center gap-3">
                    <button class="btn btn-info text-light" role="button" type="sumbit">Valider le rapport</button>
                    <a href="#" class="btn btn-info text-light" role="button">Retour</a>
                </div>
            </form>
        </div>
    </div>
</section>