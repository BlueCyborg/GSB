<script>
    var numb = 0; //initilisation du nombre de spécialités
    document.body.onload = addList; //Au chargement de la page on ajoute par défaut une nouvelle liste

    function suppList() { //Fonction permettant d'enlever la dernière spécialitée
        if (numb != 1) {
            let lastSelect = "select-" + numb;
            const element = document.getElementById(lastSelect);
            element.remove();
            numb--;
        }
    }

    function addList() { //Fonction permettant de rajouter une nouvelle spécialitée
        numb++;
        const select = document.createElement("select");
        select.id = "select-" + numb;
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

<div style="margin-left:10px;">
    <div class="py-lg-5 mx-auto">
        <div class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3">
            <h3 style="text-align:center">Créer un médecin : </h3>
            <form action="" method="POST" style="text-align:right">
                <br>
                <p>Nom :
                    <input type="text" name="nom_medecin" required />
                    <br>Prénom :
                    <input type="text" name="prenom_medecin" required />
                    <br>Adresse :
                    <input type="text" name="adresse_medecin" required />
                    <br>Code postal :
                    <input type="text" name="cp_medecin" required />
                    <br>Ville :
                    <input type="text" name="ville_medecin" required />
                    <br>Coefficient notoriété :
                    <input type="number" step="0.01" min="0" name="coefficient_notoriete" required />
                    <br><br>Type :
                    <select name="type_medecin" class="form-select" required>
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
                    <br><br>Coefficient confiance :
                    <input type="number" min="0" name="coefficient_confiance" required />
                    <br><br>
                <div id="selection">
                    Spécialitée :
                </div>
                <button type="button" class="btn btn-outline-primary" onClick="addList()">Ajouter</button>
                <button type="button" class="btn btn-outline-primary" onClick="suppList()">Enlever</button>
                <br><br>
                <button type="submit" name="submit" class="btn btn-outline-primary">Créer</button>
                </p>
            </form>
        </div>
    </div>
</div>