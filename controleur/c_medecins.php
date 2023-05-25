<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
    $action = "formulaireMedecin";
} else {
    $action = $_REQUEST['action'];
}
switch ($action) {
    case 'formulaireMedecin': {
            if (!isset($_REQUEST['medecin'])) {
                $result = getMedecinRegion($_SESSION['region']);
                include("vues/v_formulaireMedecin.php");
            }
            break;
        }
    case 'gererMedecin': {
            if (isset($_POST['formulaire_medecin'])) { //Si le délégué visiteur à changé les valeurs d'un médecin
                updateUnMedecin($_POST['id_medecin'], $_POST['nom_medecin'], $_POST['prenom_medecin'], $_POST['adresse_medecin'], $_POST['cp_medecin'], $_POST['ville_medecin'], $_POST['coeffNotoriete'], $_POST['type_medecin'], $_POST['coeffConfiance'], $_POST['select'], $_POST['diplome_medecin'], $_POST['coefficient_prescription']);
                if (!isset($e)) { // S'il n'y a pas d'erreurs lors de l'éxécution de la fonction updateUnMedecin
                    echo '<div class="alert alert-success" role="alert">Modofications effectués</div>';
                    //Après affichage du message, rediriger vers la page maitre
                    header("refresh:2; url=index.php?uc=medecin&action=formulaireMedecin");
                };
            } else {
                if (isset($_REQUEST['medecin'])) {
                    $idMedecin = $_POST['medecin'];
                    $medecin = getAllInformationsMedecin($_REQUEST['medecin']);
                    array_push($medecin, getLibelleType($medecin['TYP_CODE']));
                    $types = getTypePraticien();
                    unset($types[array_search($medecin['TYP_CODE'], $types)]); //Ici l'on enlève le type du médecin par défaut dans la liste afin d'éviter un doublon
                    $specialites = getLesSpecialites();
                    $specialitesMedecin = getLesSpecialitesFromMedecin($idMedecin);
                    include("vues/v_gererMedecin.php");
                    break;
                }
            }
        }
    case 'creerMedecin': {
            if (isset($_POST['submit'])) {
                //Vérification de l'unicité des spécialités
                if (!isset(checkUniciteSpecialite($_POST['select'])[1]) == true) { // S'il n'y a pas d'erreur stocké dans le tableau
                    creerUnMedecin($_POST['nom_medecin'], $_POST['prenom_medecin'], $_POST['adresse_medecin'], $_POST['cp_medecin'], $_POST['ville_medecin'], $_POST['coefficient_notoriete'], $_POST['type_medecin'], $_POST['coefficient_confiance'], $_POST['select'], $_POST['diplome_medecin'], $_POST['coefficient_prescription']);
                    echo '<div class="alert alert-success" role="alert">Médecin crée avec succès</div>';
                    //Après affichage du message, rediriger vers la page maitre
                    header("refresh:2; url=index.php?uc=medecin&action=formulaireMedecin");
                } else {
                    echo checkUniciteSpecialite($_POST['select'])[1];
                }
            } else {
                $types = getTypePraticien();
                $specialites = getLesSpecialites();
                include("vues/v_creerMedecin.php");
            }
            break;
        }
}
