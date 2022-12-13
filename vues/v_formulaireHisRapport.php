<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Historique des rapports de sa region</h1>
            <p class="text text-center">
                Formulaire permettant d'effectuer une recherche sur l'historique des rapports de sa region.
            </p>
        </div>
        <div class="py-lg-5 py-3">
            <form action="index.php" method="get" class="formulaire-recherche col-12 m-0 p-3 d-flex flex-column gap-3 justify-align-content-stretch align-items-stretch">
                <input type="hidden" hidden name="uc" value="rapport">
                <input type="hidden" hidden name="action" value="historyRapportRegion">
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
                        <label for="colMat" class="input-group-text">Visiteur</label>
                        <select name="colMat" id="colMat" class="form-select">
                            <?php
                                if (!empty($unVisiteur)) {
                            ?>
                                <option value="<?= htmlspecialchars($unVisiteur['COL_MATRICULE']) ?>" class="text-center">
                                    <?= htmlspecialchars($unVisiteur['COL_NOM'] . ' ' . $unVisiteur['COL_PRENOM']) ?>
                                </option>
                            <?php
                                }
                            ?>

                            <option value class="text-center">- Tous les visiteurs -</option>

                            <?php
                            foreach ($lesVisiteurs as $visiteur) {
                            ?>
                                <option value="<?= htmlspecialchars($visiteur['COL_MATRICULE']) ?>">
                                    <?= htmlspecialchars($visiteur['COL_NOM'] . ' ' . $visiteur['COL_PRENOM']) ?>
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