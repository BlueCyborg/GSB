<script>
    var numb = 0; //initilisation du nombre de spécialités
    document.body.onload = addList; //Au chargement de la page on ajoute par défaut une nouvelle liste

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
        <h3 class="text-center">Créer un médecin : </h3>
        <form action="" method="POST" class="d-flex justify-content-center">
            <div class="d-flex flex-column gap-3 justify-content-center align-content-lg-stretch">
                <div>
                    <label for="nom_medecin" class="form-label">Nom :</label>
                    <input class="form-control" type="text" id="nom_medecin" name="nom_medecin" required />
                </div>
                <div>
                    <label class="form-label" for="prenom_medecin">Prénom :</label>
                    <input class="form-control" type="text" id="prenom_medecin" name="prenom_medecin" required />
                </div>
                <div>
                    <label class="form-label" for="adresse_medecin">Adresse :</label>
                    <input class="form-control" type="text" id="adresse_medecin" name="adresse_medecin" required />
                </div>
                <div>
                    <label class="form-label" for="cp_medecin">Code postal :</label>
                    <input class="form-control" type="text" id="cp_medecin" name="cp_medecin" required />
                </div>
                <div>
                    <label class="form-label" for="ville_medecin">Ville :</label>
                    <input class="form-control" type="text" id="ville_medecin" name="ville_medecin" required />
                </div>
                <div>
                    <label class="form-label" for="coefficient_notoriete">Coefficient notoriété :</label>
                    <input class="form-control" id="coefficient_notoriete" type="number" step="0.01" min="0" name="coefficient_notoriete" value="0.00" required />
                </div>
                <div>
                    <label class="form-label" for="type_medecin">Type :</label>
                    <select class="form-select" name="type_medecin" class="form-select" required>
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
                    <label class="form-label" for="coefficient_confiance">Coefficient confiance :</label>
                    <input class="form-control" id="coefficient_confiance" type="number" min="0" name="coefficient_confiance" value="0" required />
                </div>
                <div class="d-flex flex-column justify-content-end gap-3">
                    <label>Spécialitée : </label>
                    <div id="selection" class="d-flex flex-column gap-3">
                    </div>
                    <div class="d-flex flex-row gap-3">
                        <button type="button" class="btn btn-outline-success flex-fill" onClick="addList()">Ajouter</button>
                        <button type="button" class="btn btn-outline-danger flex-fill" onClick="suppList()">Enlever</button>
                    </div>
                    <div>
                        <label class="form-label" for="diplome_medecin">Diplome :</label>
                        <input class="form-control" type="text" id="diplome_medecin" name="diplome_medecin" maxlength="10" value="" required />
                    </div>
                    <div>
                        <label class="form-label" for="coefficient_prescription">Coefficient prescription :</label>
                        <input class="form-control" type="number" id="coefficient_prescription" name="coefficient_prescription" step="0.01" min="0" value="0.00" required />
                    </div>
                    <button type="submit" name="submit" class="btn btn-outline-primary">Créer</button>
                </div>
                </p>
            </div>
        </form>
    </div>
</div>