<?php

if (isset($_GET['id']) && $_GET['id'] > 0) {
    
    //création d'une instance de classe Patient et Appointment
    $patient = new Patient();
    $appointments = new Appointment();

    $patient->id = htmlspecialchars($_GET['id']);
    $appointments->idPatients = htmlspecialchars($_GET['id']);

    //récupération du profil Patient et Appointment
    $patientProfile = $patient->getPatientProfile();
    $appointmentInfo = $appointments->showAppointment();
  
    // Permet de verifier si l'id existe dans la base de donnée
    if (!is_object($patientProfile)) {
        header('Location: ../views/exo2_listPatient.php');
        exit();
    }
    // Le else permet de renvoyer l'utilisateur si il y a autre chose qu'un type int
} else {
    header('Location: ../views/exo2_listPatient.php');
    exit();
}
?>


