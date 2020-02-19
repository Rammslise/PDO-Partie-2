<?php

if (isset($_SESSION['message'])) {
    //récupération de la donnée de session.
    $message = htmlspecialchars($_SESSION['message']);

    // La donnée de session est supprimée, pour éviter qu'elle ne se réaffiche ultérieurement.
    unset($_SESSION['message']);
}
$appointment = new Appointment();
$appointmentList = $appointment->getAppointmentList();
?>
