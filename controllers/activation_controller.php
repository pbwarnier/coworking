<?php
	include dirname(__FILE__).'/../utils/get_scriptname.php';
	require dirname(__FILE__).'/../config/config.php'; // include const
	require_once dirname(__FILE__).'/../models/User.php'; // insert class User
	require_once dirname(__FILE__).'/../models/Company.php'; // insert class Company
	require_once dirname(__FILE__).'/../models/Inscription.php'; // insert class Inscription
	require_once dirname(__FILE__).'/../utils/mails.php';

	$error = [];
	$activateSuccess = false;

	if (ctype_digit($_GET['id']) && isset($_GET['token'])) {
		$user = new User(['id' => $_GET['id'], 'temporary_code' => $_GET['token']]);
		$inscription = new Inscription(['user_id' => $_GET['id']]);
		$exist = $user->checkToken();
		(int) $interval = $inscription->checkTimeToRegister();

		if ($exist == 0 || $interval > 48) {
			$error['token'] = 'Ce lien d\'activation n\'est plus valide';
		}
		
		if (count($error) == 0) {
			$user->permission();
			$permission = openssl_decrypt($user->permission, 'AES-128-ECB', CRYPT_KEY);

			if ($permission == 2) {
				try {
					$company = new Company(['users_id_manager' => $_GET['id']]);
					$company->getCode(); // get company code
					$user->database->beginTransaction(); // start transaction
					$inscription->activateAccount();
					$user->resetToken();
					$activateSuccess = $user->database->commit();
				}
				catch (PDOException $e) {
					echo $e->getMessage();
					$user->database->rollBack(); // canceled queries
				}

				// create folders necessary for user
				$pathList = array('/../users/'.$user->id, '/../users/'.$user->id.'/arrets_maladie', '/../users/'.$user->id.'/cloud', '/../users/'.$user->id.'/fiches_de_paie', '/../users/'.$user->id.'/fiches_de_paie', '/../users/'.$user->id.'/plannings', '/../users/'.$user->id.'/img');

				foreach ($pathList as $path) {
					if (!mkdir($path, 0777, true)) { // create folder
    					die('Echec lors de la création du répertoire '.$path); // show error message
					}
				}
			}
			elseif ($permission == 1) {
				
			}
		}
	}

	$title = 'Activation du compte Co\'working';
	$description = 'Activer mon comptre Co\'working et commencer à personnaliser mon compte';

	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/activation_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer
	