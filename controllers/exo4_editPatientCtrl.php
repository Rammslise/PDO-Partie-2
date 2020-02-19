<?php

//on démarre la session
session_start();
//regex NOM et PRÉNOM
define('NAME_REGEX', '/^[a-zA-ZÀ-ÿ\' -]+$/');
//regex DATE
define('DATE_REGEX', '/^(19|20)[0-9]{2}-[0-9]{2}-[0-9]{2}$/');
//regex TÉLÉPHONE
define('PHONE_REGEX', '/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/');
//regex MAIL
define('MAIL_REGEX', '/\A[A-Z0-9.%+-]+@[A-Z0-9.-]+.[A-Z]{2,}\Z/i');

if (isset($_POST['submit'])) { // APRES SOUMISSION DU FORMULAIRE
    //création d'une instance de classe Patient.
    $profile = new Patient();

    //recupération des données du formulaire
    $profile->id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
    $profile->lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
    $profile->firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
    $profile->birthdate = isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : '';
    $profile->phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $profile->mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '';

    //validation du NOM
    if (empty($profile->lastname)) {
        $profile->formErrors['lastname'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(NAME_REGEX, $profile->lastname)) {
        $profile->formErrors['lastname'] = 'Le format du nom renseigné n\'est pas valide';
    } elseif (strlen($profile->lastname) < 2 || strlen($profile->lastname) > 25) {
        $profile->formErrors['lastname'] = 'Le nom doit comporté entre 2 et 25 caractères';
    }

    //validation du PRÉNOM
    if (empty($profile->firstname)) {
        $profile->formErrors['firstname'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(NAME_REGEX, $profile->firstname)) {
        $profile->formErrors['firstname'] = 'Le format du prénom renseigné n\'est pas valide';
    } elseif (strlen($profile->firstname) < 2 || strlen($profile->firstname) > 25) {
        $profile->formErrors['firstname'] = 'Le prénom doit comporté entre 2 et 25 caractères';
    }

    //validation de la DATE DE NAISSANCE
    if (empty($profile->birthdate)) {
        $profile->formErrors['birthdate'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(DATE_REGEX, $profile->birthdate)) {
        $profile->formErrors['birthdate'] = 'Le format de la date n\'est pas valide';
        //si la date d'aujourd'hui est inférieur à la date de naissance, on renvoit une erreur.
    } elseif (time() < strtotime($profile->birthdate)) {
        $profile->formErrors['birthdate'] = 'Cette date de naissance n\'est pas possible';
    }

    //validation du TÉLÉPHONE
    if (empty($profile->phone)) {
        $profile->formErrors['phone'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(PHONE_REGEX, $profile->phone)) {
        $profile->formErrors['phone'] = 'Le format du numéro de téléphone n\'est pas valide';
    }

    //validation du MAIL
    if (empty($profile->mail)) {
        $profile->formErrors['mail'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(MAIL_REGEX, $profile->mail)) {
        $profile->formErrors['mail'] = 'Merci de rentrer une adresse mail valide';
    } elseif (strlen($profile->mail) > 100) {
        $profile->formErrors['mail'] = 'L\'adresse mail est trop longue';
    } elseif (!$profile->hasUniqueMail()) {
        // Verifie si l'adresse mail existe déjà en base de données
        $profile->formErrors['mail'] = 'Mail existant, veuillez saisir une adresse mail différente';
    }

    //insertion du patient en BDD 
    if (empty($profile->formErrors)) {
        $success = $profile->editPatientProfile();

        if ($success) {
            $_SESSION['message'] = 'Patient(e) modifié(e)';
            header('Location: exo3_profilePatient.php?id=' . $profile->id);
            exit();
        } else {
            $message = 'Impossible de modifier le patient';
        }
    }

    // AVANT SOUMISSION DU FORMULAIRE
} elseif (isset($_GET['id']) && $_GET['id'] > 0) {
    //création d'une instance de classe Patient
    $patient = new Patient();

    $patient->id = htmlspecialchars($_GET['id']);

    //récupération du profil Patient
    $profile = $patient->getPatientProfile();

    if (!is_object($profile)) {
        header('Location: ../views/exo2_listPatient.php');
        exit();
    }
}
?>

