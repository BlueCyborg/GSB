<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Informations du praticien <span class="carac"><?=htmlspecialchars($carac['PRA_NOM'])?></span></h1>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5">
                <img class="img-fluid" src="assets/img/praticien.jpg">
            </div>
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
                <div class="formulaire">
                    <p><span class="carac">Numéro praticien</span> : <?=htmlspecialchars($carac['PRA_NUM'])?></p>
                    <p><span class="carac">Nom</span> : <?=htmlspecialchars($carac['PRA_NOM'])?></p>
                    <p><span class="carac">Prenom</span> : <?=htmlspecialchars($carac['PRA_PRENOM'])?></p>
                    <p><span class="carac">Adresse</span> : <?=htmlspecialchars($carac['PRA_ADRESSE'])?></p>
                    <p><span class="carac">Code Postal</span> : <?=htmlspecialchars($carac['PRA_CP'])?></p>
                    <p><span class="carac">Ville</span> : <?=htmlspecialchars($carac['PRA_VILLE'] . '€')?></p>
                    <p><span class="carac">Coefficien Notoriete</span> : <?=htmlspecialchars($carac['PRA_COEFNOTORIETE'])?></p>
                    <p><span class="carac">Code</span> : <?=htmlspecialchars($carac['TYP_CODE'])?></p>
                    <p><span class="carac">Coefficien Confiance</span> : <?=htmlspecialchars($carac['PRA_COEFCONFIANCE'])?></p>
                    <input class="btn btn-info text-light valider col-6 col-sm-5 col-md-4 col-lg-3" type="button" onclick="history.go(-1)" value="Retour">
                </div>
            </div>
        </div>
    </div>
</section>