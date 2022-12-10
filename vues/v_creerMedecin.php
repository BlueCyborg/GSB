<script>
    document.body.onload = addElement;

    function addElement() {
        const select = document.createElement("select");
        const opt1 = document.createElement("option");
        const opt2 = document.createElement("option");
        opt1.value = "1";
        opt1.text = "Option: Value 1";
        opt2.value = "2";
        opt2.text = "Option: Value 2";
        select.add(opt1, null);
        select.add(opt2, null);
        select.appendChild(opt1);
        select.appendChild(opt2);
        const div = document.getElementById("test");
        div.insertBefore(select, div.children[0]); 

    }

    // function addList() {
    //     var myParent = document.body;
    //     //Create array of options to be added
    //     var array = ["Volvo", "Saab", "Mercades", "Audi"];
    //     //Create and append select list
    //     var selectList = document.createElement("select");
    //     selectList.id = "mySelect";
    //     myParent.appendChild(selectList);
    //     //Create and append the options
    //     for (var i = 0; i < array.length; i++) {
    //         var option = document.createElement("option");
    //         option.value = array[i];
    //         option.text = array[i];
    //         selectList.appendChild(option);
    //     }
    // }
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
                    Spécialitée :
                    <select class="form-select">
                        <?php
                        foreach ($specialites as $uneSpecialite) {
                        ?>
                            <option value="<?= htmlspecialchars($uneSpecialite['SPE_CODE']); ?>">
                                <?= htmlspecialchars($uneSpecialite['SPE_LIBELLE']); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                <div id="test">

                </div>
                <button type="button" class="btn btn-outline-primary" onClick="addElement()">Ajouter</button>
                <br><br>
                <button type="submit" class="btn btn-outline-primary">Créer</button>
                </p>
            </form>
        </div>
    </div>
</div>