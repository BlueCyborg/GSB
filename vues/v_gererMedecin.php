<script>
    var numb = <?= count($specialitesMedecin) ?>; //initilisation du nombre de spécialités en fonction des spécialité du médecin

    function suppList() { //Fonction permettant d'enlever la dernière spécialitée
        if (numb != 1) {
            const element = document.getElementById("select-" + numb);
            element.remove();
            numb--;
        }
    }

    function addList() { //Fonction permettant de rajouter une nouvelle spécialitée
        numb++;
        const select = document.createElement("select");
        select.id = "select-" + numb;
        select.name = "select[" + numb + "]";
        select.className = "form-select";

        <?php
        $i = 1;
        foreach ($specialites as $uneSpecialite) { ?>
            const option<?= $i  ?> = document.createElement("option");
            option<?= $i ?>.value = "<?= htmlspecialchars($uneSpecialite['SPE_CODE']) ?>";
            option<?= $i ?>.text = "<?= htmlspecialchars($uneSpecialite['SPE_LIBELLE']) ?>";
            select.append(option<?= $i ?>);
        <?php
            $i++;
        } ?>
        const div = document.getElementById("selection");
        div.appendChild(select);
    }
</script>
<div class="py-lg-5 mx-5 my-3">
    <div class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3">
        <h3 style="text-align:center">Gérer le médecin <u><?= htmlspecialchars($medecin['PRA_PRENOM'] . ' ' . $medecin['PRA_NOM']) ?></u> : </h3>
        <form action="index.php?uc=medecin&action=gererMedecin" method="POST" class="d-flex justify-content-center">
            <div class="d-flex flex-column gap-3 justify-content-center align-content-lg-stretch">
                <input name="id_medecin" type="hidden" value="<?= htmlspecialchars($idMedecin) ?>">
                <div>
                    <label for="nom_medecin" class="form-label">Nom :</label>
                    <input class="form-control" type="text" id="nom_medecin" name="nom_medecin" placeholder="Le nom du médecin" value="<?= htmlspecialchars($medecin['PRA_NOM']) ?>" />
                </div>
                <div>
                    <label for="prenom_medecin" class="form-label">Prénom :</label>
                    <input class="form-control" type="text" id="prenom_medecin" name="prenom_medecin" placeholder="Le prénom du médecin" value="<?= htmlspecialchars($medecin['PRA_PRENOM']) ?>" />
                </div>
                <div>
                    <label for="adresse_medecin" class="form-label">Adresse :</label>
                    <input class="form-control" type="text" id="adresse_medecin" name="adresse_medecin" placeholder="L'adresse du médecin" value="<?= htmlspecialchars($medecin['PRA_ADRESSE']) ?>" />
                </div>
                <div>
                    <label for="cp_medecin" class="form-label">Code postal :</label>
                    <input class="form-control" type="text" id="cp_medecin" name="cp_medecin" placeholder="Le code postal du médecin" value="<?= htmlspecialchars($medecin['PRA_CP']) ?>" />
                </div>
                <div>
                    <label for="ville_medecin" class="form-label">Ville :</label>
                    <input class="form-control" type="text" id="ville_medecin" name="ville_medecin" placeholder="La ville du médecin" value="<?= htmlspecialchars($medecin['PRA_VILLE']) ?>" />
                </div>
                <div>
                    <label for="coeffNotoriete" class="form-label">Coefficient de notoriété :</label>
                    <input class="form-control" type="number" min="0" step="0.01" id="coeffNotoriete" name="coeffNotoriete" value="<?= htmlspecialchars($medecin['PRA_COEFNOTORIETE']) ?>" />
                </div>
                <div>
                    <label class="form-label" for="type_medecin">Type :</label>
                    <select class="form-select" name="type_medecin" class="form-select">
                        <option value="<?= htmlspecialchars($medecin['TYP_CODE']); ?>" selected>
                            <?= " - " . htmlspecialchars($medecin[0]['TYP_LIBELLE']) . " - "; ?>
                        </option>
                        <?php
                        foreach ($types as $unType) {
                        ?>
                            <option value="<?= htmlspecialchars($unType['TYP_CODE']); ?>">
                                <?= htmlspecialchars($unType['TYP_LIBELLE']); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="coeffConfiance" class="form-label">Coefficient de confiance :</label>
                    <input class="form-control" type="number" min="0" id="coeffConfiance" name="coeffConfiance" value="<?= htmlspecialchars($medecin['PRA_COEFCONFIANCE']) ?>" />
                </div>
                <label>Spécialitée : </label>
                <?php
                //Précharge les spécialités
                for ($i = 0; $i < count($specialitesMedecin); $i++) { ?>
                    <select name="select[<?= $i + 1 ?>]" id="select-<?= $i + 1 ?>" class="form-select">
                        <?php foreach ($specialites as $uneSpecialite) {
                            //Préséléction des valeurs du médecin
                            if ($specialitesMedecin[$i]["SPE_CODE"] == $uneSpecialite['SPE_CODE']) { ?>
                                <option selected value="<?= htmlspecialchars($specialitesMedecin[$i]["SPE_CODE"]) ?>"><?= htmlspecialchars($specialitesMedecin[$i]["SPE_LIBELLE"]) ?></option>
                            <?php } else { ?>
                                <option value="<?= htmlspecialchars($uneSpecialite['SPE_CODE']) ?>"><?= htmlspecialchars($uneSpecialite['SPE_LIBELLE']) ?></option>
                        <?php }
                        } ?>
                    </select>
                <?php }
                ?>
                <div id="selection" class="d-flex flex-column gap-3">
                </div>
                <div class="d-flex flex-row gap-3">
                    <button type="button" class="btn btn-outline-success flex-fill" onClick="addList()">Ajouter</button>
                    <button type="button" class="btn btn-outline-danger flex-fill" onClick="suppList()">Enlever</button>
                </div>
                <div>
                    <label class="form-label" for="diplome_medecin">Diplome :</label>
                    <?php
                    $diplome = "";
                    if (!is_null($medecin['POS_DIPLOME']) == true) {
                        $diplome = $medecin['POS_DIPLOME'];
                    }
                    ?>
                    <input class="form-control" type="text" id="diplome_medecin" name="diplome_medecin" maxlength="10" value="<?= $diplome ?>" placeholder="Le diplome du médecin" />
                </div>
                <div>
                <?php
                    $coeffPrescription = '0.00';
                    if ($medecin['POS_COEFPRESCRIPTION'] > 0) {
                        $coeffPrescription = $medecin['POS_COEFPRESCRIPTION'];
                    }
                    ?>
                    <label class="form-label" for="coefficient_prescription">Coefficient prescription :</label>
                    <input class="form-control" type="number" id="coefficient_prescription" name="coefficient_prescription" step="0.01" min="0" value="<?= $coeffPrescription ?>" />
                </div>
                <button type="submit" name="formulaire_medecin" class="btn btn-outline-primary">Valider les modifications</button>
            </div>
        </form>
    </div>
</div>