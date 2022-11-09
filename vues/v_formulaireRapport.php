<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Saisie du rapport N°<?=htmlspecialchars($rapNum)?></h1>
            <p class="text text-center">
                Formulaire permettant de rédiger un rapport de visite.
                <span style="color: red;">Faire les liste selectionnable</span>
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php?uc=rapport&action=saisit" method="post" class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3">
                <div class="flex-fill w-100">
                    <p class="redstar">
                        Champs obligatoires
                    </p>
                </div>
                <h2 class="titre-formulaire">Rapport de visite</h2>
                <div class="d-flex flex-row justify-content-stretch align-content-stretch w-100 gap-5 px-5">
                    <div class="d-flex justify-content-between align-content-star flex-column flex-fill">
                        <label for="rapNum" class="form-label">
                            Numéro du rapport:
                            <span id="rapNum"><?=htmlspecialchars($rapNum)?></span>
                        </label>

                        <label for="colMat" class="form-label">
                            Matricule du collaborateur:
                            <span id="colMat"><?=htmlspecialchars($colMatricule)?></span>
                        </label>
                        
                        <label for="rapPraID" class="form-label required">Praticien concerné:</label>

                        <label for="saisieDate" class="form-label required">Date de saisie:</label>
                        <input id="saisieDate" name="saisieDate" class="form-control" type="date" value=<?=htmlspecialchars($saisieDate)?>>

                        <label for="rapBilan" class="form-label required">Bilan du rapport:</label>
                        <textarea id="rapBilan" name="rapBilan" class="form-control" rows="4"><?=htmlspecialchars($rapBilan)?></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-content-star flex-column flex-fill">
                        <label for="visiteDate" class="form-label required">Date de visite:</label>
                        <input id="visiteDate" name="visiteDate" class="form-control" type="date" value=<?=htmlspecialchars($visiteDate)?>>
                        
                        <label for="idMotif" class="form-label required">Motif:</label>

                        <label for="motifAutre" class="form-label required">Autre Motif:</label>
                        <input id="motifAutre" name="motifAutre" class="form-control" type="text" value=<?=htmlspecialchars($motifAutre)?>>
                        
                        <label for="idMed1" class="form-label required">1er médicament présenté</label>
                        <label for="idMed2" class="form-label required">2eme médicament présenté</label>
                    </div>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="saisieDef" name="saisieDef">
                    <label class="form-check-label" for="saisieDef">Saisie définitive</label>
                </div>
                <div class="d-flex flex-row justify-content-center align-content-center gap-3">
                    <button class="btn btn-info text-light" role="button" type="sumbit">Valider le rapport</button>
                    <a href="#" class="btn btn-info text-light" role="button">Retour</a>
                </div>
            </form>
        </div>
    </div>
</section>