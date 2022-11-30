<br>
<div style="margin-left:10px;">
    <h1>Créer un médecin : </h1><br>
    <form action="" method="POST">
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
            <select name="type_medecin" required>
                <?php foreach ($types as $unType) { ?>
                    <option value="<?= $unType['TYP_CODE'] ?>"><?= $unType['TYP_LIBELLE'] ?></option>
                <?php } ?>
            </select>
            <br><br>Coefficient confiance :
            <input type="number" min="0" name="coefficient_confiance" required />
            <br>
            <button type="button" class="btn btn-outline-primary" onClick="javascript:.add()" >Ajouter</button>
            <button type="submit" class="btn btn-outline-primary">Créer</button>
        </p>
    </form>
</div>