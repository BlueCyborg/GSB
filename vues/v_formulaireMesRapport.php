<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Mes Rapports</h1>
            <p class="text text-center">
                Formulaire permettant d'effectuer une recherche sur ses rapports.
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php" method="get" class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3 justify-align-content-stretch align-items-stretch">
                <input type="hidden" hidden name="uc" value="rapport">
                <input type="hidden" hidden name="action" value="mesRapports">
                <h2 class="titre-formulaire align-self-center">Critères de recherche</h2>
                <div class="d-flex flex-lg-row flex-column justify-content-stretch align-content-stretch gap-5 px-5">
                    <div class="input-group">
                        <label for="startDate" class="input-group-text">Date de depart</label>
                        <input id="startDate" name="startDate" class="form-control" type="date" value=<?= htmlspecialchars($startDate) ?>>
                    </div>
                    <div class="input-group">
                        <label for="endDate" class="input-group-text">Date de fin</label>
                        <input id="endDate" name="endDate" class="form-control" type="date" value=<?= htmlspecialchars($endDate) ?>>
                    </div>
                    <div class="input-group">
                        <label for="praID" class="input-group-text">Praticien</label>
                        <select name="praID" id="praID" class="form-select">
                            <?php
                                if (!empty($unPraticien)) {
                            ?>
                                <option value="<?= htmlspecialchars($unPraticien['PRA_NUM']) ?>" class="text-center">
                                    <?= htmlspecialchars($unPraticien['PRA_NOM'] . ' ' . $unPraticien['PRA_PRENOM']) ?>
                                </option>
                            <?php
                                }
                            ?>

                            <option value class="text-center">- Tous les praticiens -</option>

                            <?php
                            foreach ($lesPraticiens as $praticien) {
                            ?>
                                <option value="<?= htmlspecialchars($praticien['PRA_NUM']) ?>">
                                    <?= htmlspecialchars($praticien['PRA_NOM'] . ' ' . $praticien['PRA_PRENOM']) ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr class="">
                <div class="d-flex flex-fill justify-content-center">
                    <button class="btn btn-info text-light col-lg-6 col-10" role="button" type="sumbit">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</section>