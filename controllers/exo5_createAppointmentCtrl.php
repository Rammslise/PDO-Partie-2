<?php

//on démarre la session
session_start();

//definition des regex pour la validation du formulaire
define('REGEX_DATE', '/^(19|20)[0-9]{2}-[0-9]{2}-[0-9]{2}$/');
define('REGEX_TIME', '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/');
define('REGEX_MAIL', '/^[^\W]?[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*\@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*\.[a-zA-Z]{2,4}$/');

// Initialisation du tableau des erreurs dans la classe Patients
// Gestion d'erreur générale d'envoi du formulaire
if (isset($_POST['submit'])) {
    $patient = new Patient();
    $appointment = new Appointment();

// récupération des données du formulaire
    $appointment->date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
    $appointment->time = isset($_POST['hour']) ? htmlspecialchars($_POST['hour']) : '';
    $patient->mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '';

    // validation de la date du rendez-vous
    if (empty($appointment->date)) {
        $appointment->formErrors['date'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_DATE, $appointment->date)) {
        $appointment->formErrors['date'] = 'Ce champ n\'est pas valide';
    } elseif (strtotime($appointment->date) < time()) {
        $appointment->formErrors['date'] = 'veuillez entrer une date postérieure à la date du jour';
    }

    // validation de l'heure du rendez-vous
    if (empty($appointment->time)) {
        $appointment->formErrors['hour'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_TIME, $appointment->time)) {
        $appointment->formErrors['hour'] = 'Ce champ n\'est pas valide';
    }

    // concatenation de la date et l'heure
    $appointment->dateHour = $appointment->date . ' ' . $appointment->time . ':00';

    if (empty($appointment->formErrors['date']) && empty($appointment->formErrors['hour'])) {
        // vérification de la disponibilité du créneau horaire
        if ($appointment->hasUniqueTimeSlot()) {
            $appointment->formErrors['hour'] = 'Ce créneau horaire est indisponible, veuillez en choisir un autre';
            $appointment->formErrors['date'] = 'Ce créneau horaire est indisponible, veuillez en choisir un autre';
        }
    }

// validation de l'adresse mail
    if (empty($patient->mail)) {
        $patient->formErrors['mail'] = 'Ce champ est vide';
    } elseif (!preg_match(REGEX_MAIL, $patient->mail)) {
        $patient->formErrors['mail'] = 'Ce champ n\'est pas valide';
    } elseif (!is_object($patient->getPatientByMail())) {
        $patient->formErrors['mail'] = 'L\'adresse e-mail n\'existe pas, le patient doit etre enregistré';
    }

// vérification que tous les champs sont prêts à etre envoyés 
    if (empty($appointment->formErrors) && empty($patient->formErrors)) {


// association d'un id grace au mail renseigné
        $appointment->idPatients = $patient->getPatientByMail()->id;

// insertion des données
        $success = $appointment->createAppointment();

        if ($success) {
            $_SESSION['message'] = 'Le rendez-vous a bien été créé';
            header('Location: ../views/exo6_listAppointment.php');
            exit();
        } else {
            $message = 'Le rendez-vous n\'a pas pu être créé';
        }
    }
}
?>

