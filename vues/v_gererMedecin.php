<div style="margin-left:10px;" class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
    <div class="formulaire-recherche col-12 m-0">
        <h3 style="text-align:center">Gérer le médecin <u><?= htmlspecialchars($medecin['PRA_PRENOM'] . ' ' . $medecin['PRA_NOM']) ?></u> : </h3>
        <form action="index.php?uc=medecin&action=gerermedecin" method="POST" style="text-align:right">
            <br>
            <input name="id_medecin" type="hidden" value="<?= htmlspecialchars($idMedecin) ?>">
            <p>Nom :
                <input type="text" name="nom_medecin" value="<?= htmlspecialchars($medecin['PRA_NOM']) ?>" />
                <br>
                Prénom :
                <input type="text" name="prenom_medecin" value="<?= htmlspecialchars($medecin['PRA_PRENOM']) ?>" />
                <br>
                Adresse :
                <input type="text" name="adresse_medecin" value="<?= htmlspecialchars($medecin['PRA_ADRESSE']) ?>" />
                <br>
                Code postal :
                <input type="text" name="cp_medecin" value="<?= htmlspecialchars($medecin['PRA_CP']) ?>" />
                <br>
                Ville :
                <input type="text" name="ville_medecin" value="<?= htmlspecialchars($medecin['PRA_VILLE']) ?>" />
                <br>
                Coefficient de notoriétée :
                <input type="text" name="coeffNotoriete" value="<?= htmlspecialchars($medecin['PRA_COEFNOTORIETE']) ?>" />
                <br>
                Type code :
                <input type="text" name="type_code" value="<?= htmlspecialchars($medecin['TYP_CODE']) ?>" />
                <br>
                Coefficient de confiance :
                <input type="text" name="coeffConfiance" value="<?= htmlspecialchars($medecin['PRA_COEFCONFIANCE']) ?>" />
                <br>
                <input type="submit" name="formulaire_medecin" value="Valider les modifications">
            </p>
        </form>
    </div>
</div>