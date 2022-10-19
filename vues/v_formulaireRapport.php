<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Formulaire de praticiens</h1>
            <p class="text text-center">
                Formulaire permettant d'afficher toutes les informations
                à propos d'un praticien en particulier.
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php?uc=rapport&action=saisit" method="post" class="formulaire-recherche col-12 m-0 d-flex justify-content-between align-content-star flex-column p-3">
                <p class="flex-fill redstar">
                    Champs obligatoires
                </p>
                <div class="d-flex justify-content-between align-content-star flex-column">
                    <label class="titre-formulaire" for="listemedoc">Rapport de visite :</label>
                    <select required name="praticien" class="form-select mt-3">
                        <option value class="text-center">- Choisissez un praticien -</option>
                        <?php
                        foreach ($praticiens as $praticien) {
                        ?>
                            <option value="" class="form-control"></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input class="btn btn-info text-light valider" type="submit" value="Afficher les informations">
                </div>
            </form>
        </div>
    </div>
</section>