<?php

//regex DATE
define('DATE_REGEX', '/^(19|20)[0-9]{2}-[0-9]{2}-[0-9]{2}$/');
//regex HEURE
define('HOUR_REGEX', '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/');

if (isset($_POST['submit'])) {

    $appointment = new Appointment();
        
    //récupération des données du formulaire

    $appointment->id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
    $appointment->date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
    $appointment->hour = isset($_POST['hour']) ? htmlspecialchars($_POST['hour']) : '';

    //Validation de la DATE
    if (empty($appointment->date)) {
        $appointment->formErrors['date'] = 'Ce champ est vide';
    } elseif (!preg_match(DATE_REGEX, $appointment->date)) {
        $appointment->formErrors['date'] = 'Merci de rentrer une date valide';
    } elseif (time() > strtotime($appointment->date)) {
        $appointment->formErrors['date'] = 'Impossible de sélectionner ce jour';
    }

    //Validation de l'HEURE
    if (empty($appointment->hour)) {
        $appointment->formErrors['hour'] = 'Ce champ est vide';
    } elseif (!preg_match(HOUR_REGEX, $appointment->hour)) {
        $appointment->formErrors['hour'] = 'Merci de rentrer une heure valide';
    }

    //Validation et vérification de la DATE du rdv avec le rappel de la méthode 'hasUniqueTimeSlot' définie dans la base 'Appointment'.
    if (empty($appointment->formErrors['date']) && empty($appointment->formErrors['hour'])) {
        $appointment->dateHour = $appointment->date . ' ' . $appointment->hour . ':00';
        if ($appointment->hasUniqueTimeSlot()) {
            $appointment->formErrors['date'] = 'Jour non disponible';
        }
    }

    //insertion de la modification du rdv en BDD 
    if (empty($appointment->formErrors)) {
        $success = $appointment->editAppointmentInfo();

        if ($success) {
            $_SESSION['message'] = 'Rendez-vous modifié';
            header('Location: ../views/exo7_getAppointment.php?id=' . $appointment->id);
            exit();
        } else {
            $message = 'Impossible de modifier le rendez-vous';
        }
    }
} elseif (isset($_GET['id']) && $_GET['id'] > 0) { // AVANT SOUMISSION DU FORMULAIRE

    $appointment = new Appointment();

    $appointment->id = htmlspecialchars($_GET['id']);

    //récupération des infos du rendez-vous
    $appointmentInfo = $appointment->getAppointmentInfo();

    if (!is_object($appointmentInfo)) {
        header('Location: ../views/exo6_listAppointment.php');
        exit();
    }
} else {
    header('Location: ../views/exo6_listAppointment.php');
    exit();
}

?>