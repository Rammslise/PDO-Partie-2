<?php

//regex NOM et PRÉNOM
define('NAME_REGEX', '/^[a-zA-ZÀ-ÿ\' -]+$/');
//regex DATE
define('DATE_REGEX', '/^(19|20)[0-9]{2}-[0-9]{2}-[0-9]{2}$/');
//regex TÉLÉPHONE
define('PHONE_REGEX', '/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/');
//regex MAIL
define('MAIL_REGEX', '/\A[A-Z0-9.%+-]+@[A-Z0-9.-]+.[A-Z]{2,}\Z/i');

if (isset($_POST['submit'])) {
    //création d'une instance de classe Patient.
    $patient = new Patient();

    //récupération des données du formulaire
    $patient->lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
    $patient->firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
    $patient->birthdate = isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : '';
    $patient->phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $patient->mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '';

    //validation du NOM
    if (empty($patient->lastname)) {
        $patient->formErrors['lastname'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(NAME_REGEX, $patient->lastname)) {
        $patient->formErrors['lastname'] = 'Le format du nom renseigné n\'est pas valide';
    } elseif (strlen($patient->lastname) < 2 || strlen($patient->lastname) > 25) {
        $patient->formErrors['lastname'] = 'Le nom doit comporté entre 2 et 25 caractères';
    }

    //validation du PRÉNOM
    if (empty($patient->firstname)) {
        $patient->formErrors['firstname'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(NAME_REGEX, $patient->firstname)) {
        $patient->formErrors['firstname'] = 'Le format du prénom renseigné n\'est pas valide';
    } elseif (strlen($patient->firstname) < 2 || strlen($patient->firstname) > 25) {
        $patient->formErrors['firstname'] = 'Le prénom doit comporté entre 2 et 25 caractères';
    }

    //validation de la DATE DE NAISSANCE
    if (empty($patient->birthdate)) {
        $patient->formErrors['birthdate'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(DATE_REGEX, $patient->birthdate)) {
        $patient->formErrors['birthdate'] = 'Le format de la date n\'est pas valide';
        //si la date d'aujourd'hui est inférieur à la date de naissance, on renvoit une erreur.
    } elseif (time() < strtotime($patient->birthdate)) {
        $patient->formErrors['birthdate'] = 'Cette date de naissance n\'est pas possible';
    }

    //validation du TÉLÉPHONE
    if (empty($patient->phone)) {
        $patient->formErrors['phone'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(PHONE_REGEX, $patient->phone)) {
        $patient->formErrors['phone'] = 'Le format du numéro de téléphone n\'est pas valide';
    }

    //validation du MAIL
    if (empty($patient->mail)) {
        $patient->formErrors['mail'] = 'Merci de remplir ce champs';
    } elseif (!preg_match(MAIL_REGEX, $patient->mail)) {
        $patient->formErrors['mail'] = 'Merci de rentrer une adresse mail valide';
    } elseif (strlen($patient->mail) > 100) {
        $patient->formErrors['mail'] = 'L\'adresse mail est trop longue';
    } elseif (!$patient->hasUniqueMail()) {
        // Verifie si l'adresse mail existe déjà en base de données
        $patient->formErrors['mail'] = 'Mail existant, veuillez saisir une adresse mail différente';
    }

    //éxecution de la requête dans le cas où aucune erreur n'est reportée dans le tableau d'erreurs.
    if (empty($patient->formErrors)) {
        //insertion du patient en base de données
        $success = $patient->createPatient();

        if ($success) {
            $_SESSION['message'] = 'Le patient a bien été créé';
        } else {
            $_SESSION['message'] = 'Le patient n\'a pas pu être créé';
        }

        header('Location: ../views/exo2_listPatient.php');
        exit();
    }
}
?>


