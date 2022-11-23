<br>
<div style="margin-left:10px;">
    <h1>Gérer le médecin <u><?= $medecin['PRA_PRENOM'] . ' ' . $medecin['PRA_NOM'] ?></u> : </h1>

    <form action="index.php?uc=medecin&action=gerermedecin" method="POST">
        <p>Nom :
            <input type="text" name="nom_praticien" value="<?= $medecin['PRA_NOM'] ?>" />
            <br>
            Prénom :
            <input type="text" name="prenom_praticien" value="<?= $medecin['PRA_PRENOM'] ?>" />
            <br>
            Adresse :
            <input type="text" name="adresse_praticien" value="<?= $medecin['PRA_ADRESSE'] ?>" />
            <br>
            Code postal :
            <input type="text" name="cp_praticien" value="<?= $medecin['PRA_CP'] ?>" />
            <br>
            Ville :
            <input type="text" name="ville_praticien" value="<?= $medecin['PRA_VILLE'] ?>" />
            <br>
            Coefficient de notoriétée :
            <input type="text" name="coeffNotoriete_praticien" value="<?= $medecin['PRA_COEFNOTORIETE'] ?>" />
            <br>
            Type code :
            <input type="text" name="coeff_praticien" value="<?= $medecin['TYP_CODE'] ?>" />
            <br>
            Coefficient de confiance :
            <input type="text" name="coeffConfiance_praticien" value="<?= $medecin['PRA_COEFCONFIANCE'] ?>" />
            <br>
            <input type="submit" name="formulaire_medecin" value="Valider les modifications">
        </p>
    </form>
</div>