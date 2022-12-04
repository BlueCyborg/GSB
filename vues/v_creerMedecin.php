<div style="margin-left:10px;">
    <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
        <div class="formulaire-recherche col-12 m-0">
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
                    <select name="type_medecin" required>
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
                    <button type="button" class="btn btn-outline-primary" onClick="//javascript:.add()">Ajouter</button>
                    <button type="submit" class="btn btn-outline-primary">Créer</button>
                </p>
            </form>
        </div>
    </div>
</div>