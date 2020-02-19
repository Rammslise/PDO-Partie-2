<?php

if (isset($_SESSION['message'])) {
    //récupération de la donnée de session.
    $message = htmlspecialchars($_SESSION['message']);

    // La donnée de session est supprimée, pour éviter qu'elle ne se réaffiche ultérieurement.
    unset($_SESSION['message']);
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
    //création d'une instance de classe Patient
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

