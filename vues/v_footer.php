<div id="foot">
    <footer class="pt-4 d-flex flex-column justify-content-between">
        <div class="container">
            <div class="row pt-4">
                <div class="col-lg-3 col-12 align-left">
                    <a class="navbar-brand" href="index.php?uc=accueil">
                        <span class="text-light h5"><u>Projet GSB</u></span>
                    </a>
                    <p class="text-light my-lg-4 my-2">
                        Projet de BTS SIO 2ème année : Rédaction et suivi de rapport de visite sous forme d'un site Web pour l'entreprise GSB avec base de donnée.
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 my-sm-0 mt-4">
                    <h3 class="h4 pb-lg-3 text-light light-300">Information</h3>
                        <ul class="list-unstyled text-light light-300">
                            <li class="pb-2">
                                <i class='bx-fw bx bxs-chevron-right bx-xs'></i><a class="text-decoration-none text-light" href="index.php?uc=accueil">Accueil</a>
                            </li>
                            <?php 
                                if (isset($_SESSION['habilitation']) && $_SESSION['habilitation'] >= 1) {
                            ?>
                                <li class="pb-2">
                                    <i class="bx-fw bx bxs-chevron-right bx-xs"></i><a class="text-decoration-none text-light py-1" href="index.php?uc=medicaments&action=formulairemedoc">Médicaments</a>
                                </li>
                                <li class="pb-2">
                                    <i class="bx-fw bx bxs-chevron-right bx-xs"></i><a class="text-decoration-none text-light py-1" href="index.php?uc=praticiens&action=formulairepraticien">Praticiens</a>
                                </li>
                                <?php if ($_SESSION['habilitation'] >= 2) { ?>
                                    <li class="pb-2">
                                        <i class="bx-fw bx bxs-chevron-right bx-xs"></i><a class="text-decoration-none text-light py-1" href="index.php?uc=medecin&action=formulairemedecin">Gérer médecin</a>
                                    </li>
                                <?php } ?>
                                <li class="pb-2 dropdown">
                                    <i class="bx-fw bx bxs-chevron-right bx-xs"></i><a class="text-decoration-none text-light py-1" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rapport de visite</a>
                                    <ul class="dropdown-menu dropdown-menu-dark p-0">
                                        <li><a class="dropdown-item" href="index.php?uc=rapport&action=redigerRapport">Rédiger un rapport</a></li>
                                        <li><a class="dropdown-item" href="index.php?uc=rapport&action=mesRapports">Mes rapports</a></li>
                                        <?php if ($_SESSION['habilitation'] >= 2) { ?>
                                            <li>
                                                <a class="dropdown-item" href="index.php?uc=rapport&action=newRapportRegion">Nouveaux rapports</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="index.php?uc=rapport&action=historyRapportRegion">Historique des rapports</a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                <li class="pb-2">
                                    <i class="bx-fw bx bxs-chevron-right bx-xs"></i><a class="text-decoration-none text-light py-1" href="index.php?uc=connexion&action=profil">Profil</a>
                                </li>
                            <?php } else { ?>
                                <li class="pb-2">
                                    <i class="bx-fw bx bxs-chevron-right bx-xs"></i><a class="text-decoration-none text-light py-1" href="index.php?uc=connexion&action=connexion">Connexion</a>
                                </li>
                            <?php } ?>
                        </ul>
                </div>
            </div>
        </div>

        <div class="w-100 footercustom pt-3">
            <div class="container">
                <div class="row pt-2 d-flex justify-content-center">
                    <div class="col-lg-6 col-sm-12">
                        <p class="text-center text-light light-300">
                            © Copyright 2022 Randy Durelle | Tristan Da Silva
                        </p>
                        <p class="text-center text-light light-300">
                            Modifié par Autréaux Denis & Ferre Mathys
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
</div>


<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/isotope.pkgd.js"></script>

<script src="assets/js/custom.js"></script>

</body>

</html>