<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Saisie du rapport N°<?=htmlspecialchars($rapNum)?></h1>
            <p class="text text-center">
                Formulaire permettant de rédiger un rapport de visite.
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php?uc=rapport&action=saisitRapport" method="post" class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3 justify-align-content-stretch align-items-stretch">
                <div class="flex-fill flex">
                    <p class="redstar">
                        Champs obligatoires
                    </p>
                </div>
                <h2 class="titre-formulaire align-self-center">Rapport de visite</h2>
                <div class="d-flex flex-lg-row flex-column justify-content-stretch align-content-stretch gap-5 px-5">
                    <div class="d-flex justify-content-between align-content-star flex-column flex-fill">
                        <div>
                            <label for="rapNum" class="form-label">
                                Numéro du rapport:
                                <span id="rapNum" class="text-secondary"><?=htmlspecialchars($rapNum)?></span>
                                <input name="rapNum" type="hidden" value="<?=htmlspecialchars($rapNum)?>" hidden>
                            </label>
                        </div>

                        <div>
                            <label for="colMat" class="form-label">
                                Matricule du collaborateur:
                                <span id="colMat" class="text-secondary"><?=htmlspecialchars($colMatricule)?></span>
                            </label> 
                        </div>

                        <div>
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
                        </div>

                        <div>
                            <label for="rapRempID" class="form-label">Remplacant concerné:</label>
                            <select name="rapRempID" id="rapRempID" class="form-select">
                                <?php
                                    if (empty($unRemplacant)) {
                                ?>
                                    <option value class="text-center" selected>- Pas de remplacant -</option>
                                <?php
                                    } else {
                                ?>
                                    <option value="<?=htmlspecialchars($unRemplacant['PRA_NUM'])?>" class="text-center" selected>
                                        <?=htmlspecialchars($unRemplacant['PRA_NOM'].' '.$unRemplacant['PRA_PRENOM'])?>
                                    </option>
                                <?php
                                    }
                                ?>

                                <option value class="text-center">- Aucun remplacant -</option>

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
                        </div>

                        <div>
                            <label for="saisieDate" class="form-label required">Date de saisie:</label>
                            <input id="saisieDate" name="saisieDate" class="form-control" type="date" value=<?=htmlspecialchars($saisieDate)?>>
                        </div>

                        <div>
                            <label for="rapBilan" class="form-label required">Bilan du rapport:</label>
                            <textarea id="rapBilan" name="rapBilan" class="form-control" maxlength="255" rows="4"><?=htmlspecialchars($rapBilan)?></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-content-star flex-column flex-fill">
                        <div>
                            <label for="visiteDate" class="form-label required">Date de visite:</label>
                            <input id="visiteDate" name="visiteDate" class="form-control" type="date" value=<?=htmlspecialchars($visiteDate)?>>
                        </div>

                        <div>
                            <label for="idMotif" class="form-label required">Motif:</label>
                            <select name="idMotif" id="idMotif" class="form-select" onchange="updateMotif(this)">
                                <?php
                                    if (empty($unMotif)) {
                                ?>
                                    <option value class="text-center" selected>- Choisissez un motif -</option>
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
                                foreach ($lesMotifs as $motif) {
                                ?>
                                    <option value="<?=htmlspecialchars($motif['MOT_ID'])?>">
                                        <?=htmlspecialchars($motif['MOT_LIB'])?>
                                    </option>
                                <?php    
                                }
                                ?>
                            </select>
                        </div>

                        <div id="motifAutreGroup" <?php if ($unMotif['MOT_ID'] != 'OTH') {echo 'hidden';}; ?>>
                            <label for="motifAutre" class="form-label required">Autre Motif:</label>
                            <input id="motifAutre" name="motifAutre" maxlength="255" class="form-control" type="text" value=<?=htmlspecialchars($motifAutre)?>>
                        </div>

                        <div id="med1">
                            <label for="idMed1" class="form-label">1er médicament présenté</label>
                            <select name="idMed1" id="idMed1" class="form-select" onchange="updateMed(this)">
                                <?php
                                    if (!empty($preMed)) {
                                ?>
                                    <option value="<?=htmlspecialchars($preMed['MED_DEPOTLEGAL'])?>" class="text-center" selected>
                                        <?=htmlspecialchars($preMed['MED_NOMCOMMERCIAL'])?>
                                    </option>
                                <?php 
                                    }
                                ?>
                                    <option value class="text-center" id="med1None">- Aucun -</option>
                                <?php
                                    foreach ($lesMeds as $med) {
                                ?>
                                    <option value="<?=htmlspecialchars($med['MED_DEPOTLEGAL'])?>">
                                        <?=htmlspecialchars($med['MED_NOMCOMMERCIAL'])?>
                                    </option>
                                <?php    
                                    }
                                ?>
                            </select>
                                </div>

                        <div id="med2" <?php if (empty($preMed)) {echo 'hidden';}; ?>>
                            <label for="idMed2" class="form-label">2eme médicament présenté</label>
                            <select name="idMed2" id="idMed2" class="form-select">
                            <?php
                                    if (!empty($secMed)) {
                                ?>
                                    <option value="<?=htmlspecialchars($secMed['MED_DEPOTLEGAL'])?>" class="text-center" selected>
                                        <?=htmlspecialchars($secMed['MED_NOMCOMMERCIAL'])?>
                                    </option>
                                <?php 
                                    }
                                ?>
                                    <option value class="text-center" id="med2None">- Aucun -</option>
                                <?php
                                    foreach ($lesMeds as $med) {
                                ?>
                                    <option value="<?=htmlspecialchars($med['MED_DEPOTLEGAL'])?>">
                                        <?=htmlspecialchars($med['MED_NOMCOMMERCIAL'])?>
                                    </option>
                                <?php    
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="justify-content-start align-content-start gap-0 px-5">
                    <label for="ech" class="form-label">Échantillon</label>
                    <div class="form-control p-0">
                        <table class="table table-striped" id="ech">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Quantité
                                    </th>
                                    <th scope="col">
                                        Médicament
                                    </th>
                                    <th scope="col">
                                        <button class="btn btn-outline-dark" type="button" onclick="addEch()">
                                            Ajouter
                                            <i class="bi bi-plus-square"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="bodyEch">
                                <tr id="examplLine">
                                    <td>
                                        <input id="examplQte" class="form-control" type="text" pattern="[1-9][0-9]*" required/>
                                    </td>
                                    <td>
                                        <select id="examplMed" class="form-control form-select" required>
                                            <option value class="text-center">- Aucun -</option>
                                            <?php
                                                foreach ($lesMeds as $med) {
                                            ?>
                                                <option value="<?=htmlspecialchars($med['MED_DEPOTLEGAL'])?>">
                                                    <?=htmlspecialchars($med['MED_NOMCOMMERCIAL'])?>
                                                </option>
                                            <?php    
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button id="examplRm" class="btn btn-outline-danger" type="button">
                                            Retirer
                                            <i class="bi bi-x-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="">
                <div class="form-check form-switch align-self-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="saisieDef" name="saisieDef">
                    <label class="form-check-label" for="saisieDef">Saisie définitive</label>
                </div>
                <div class="d-flex flex-row justify-content-center align-content-center gap-3">
                    <button class="btn btn-info text-light" role="button" type="sumbit" onclick="return sendForm()">Valider le rapport</button>
                    <a href="index.php?uc=rapport&action=mesRapports" class="btn btn-info text-light" role="button">Retour</a>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="assets/js/rapport.js">

</script>