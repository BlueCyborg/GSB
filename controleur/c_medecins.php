<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
    $action = "formulairemedecin";
} else {
    $action = $_REQUEST['action'];
}
echo 'SESSION';
var_dump($_SESSION);
switch ($action) {
    case 'formulairemedecin': {
            if (!isset($_REQUEST['medecin'])) {
                $result = getMedecinRegion($_SESSION['region']);
                var_dump($result);
                //include("vues/v_formulaireMedecin.php");
            } else {
                $_SESSION['erreur'] = false;
                echo 'ERREUR';
            }
            break;
        }

    default: {
            header('Location: index.php?uc=medecin&action=formulairemedecin');
            break;
        }
}
