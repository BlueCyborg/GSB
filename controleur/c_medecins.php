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
                updateUnMedecin($_POST['id_medecin'], $_POST['nom_medecin'], $_POST['prenom_medecin'], $_POST['adresse_medecin'], $_POST['cp_medecin'], $_POST['ville_medecin'], $_POST['coeffNotoriete'], $_POST['type_code'], $_POST['coeffConfiance'], $_POST['formulaire_medecin']);
                if (!isset($e)) { // S'il n'y a pas d'erreurs lors de l'éxécution de la fonction gererUnMedecin
                    echo 'Modifications effectués';
                };
            } else {
                if (isset($_REQUEST['medecin'])) {
                    $idMedecin = $_POST['medecin'];
                    $medecin = getAllInformationsMedecin($_REQUEST['medecin']);
                    include("vues/v_gererMedecin.php");
                    break;
                }
            }
        }
    case 'creerMedecin': {
            if (isset($_POST['submit'])) {
                creerUnMedecin($_POST['nom_medecin'], $_POST['prenom_medecin'], $_POST['adresse_medecin'], $_POST['cp_medecin'], $_POST['ville_medecin'], $_POST['coefficient_notoriete'], $_POST['type_medecin'], $_POST['coefficient_confiance'], $_POST['select'], $_POST['diplome_medecin'], $_POST['coefficient_prescription']);
            } else {
                $types = getTypePraticien();
                $specialites = getLesSpecialites();
                include("vues/v_creerMedecin.php");
            }
            break;
        }
}
