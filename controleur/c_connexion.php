<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
	$action = "connexion";
} else {
	$action = $_REQUEST['action'];
}

switch ($action) {
	case 'connexion': {
			if (isset($_SESSION['login'])) {
				header('Location: index.php?uc=connexion&action=profil');
			} else {
				if (isset($_POST['connexion'])) {
					if (empty($_POST['username'])) {
						$userEmpty = "Veuillez saisir votre identifiant !";
					} elseif (empty($_POST['password'])) {
						$userEmpty = "Veuillez saisir votre mot de passe !";
					} else {
						$arr = checkConnexion($_POST['username'], $_POST['password']);
						if (empty($arr)) {
							$userEmpty = "Informations incorrectes !";
						} else {
							$_SESSION['habilitation'] = $arr['habilitation'];
							$_SESSION['login'] = $arr['id_log'];
							$_SESSION['matricule'] = $arr['matricule'];
							$_SESSION['erreur'] = false;
							header('Location: index.php?uc=connexion&action=profil');
							
						}
					}
				}
				
				if (!isset($_SESSION['login'])) {
					include("vues/v_connexion.php");
				}
			}
			break;
		}

	case 'deconnexion': {
			session_destroy();
			header('Location: index.php?uc=connexion&action=connexion');
			break;
		}

	case 'profil': {
			if (!isset($_SESSION['matricule'])) {
				header('Location: index.php?uc=connexion&action=connexion');
			} else {
				$info = getAllInformationCompte($_SESSION['matricule']);
				$_SESSION['region'] = $info[9];
				for ($i = 7; $i <= 8; $i++) {
					if (empty($info[$i])) {
						$info[$i] = 'Non défini(e)';
					}
				}
				include("vues/v_profil.php");
			}
			break;
		}

	default: {
			header('location: index.php?uc=connexion&action=connexion');
			break;
		}
}
?>