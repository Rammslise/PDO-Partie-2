<?php

if (isset($_SESSION['message'])) {
    //récupération de la donnée de session.
    $message = htmlspecialchars($_SESSION['message']);

    // La donnée de session est supprimée, pour éviter qu'elle ne se réaffiche ultérieurement.
    unset($_SESSION['message']);
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
    //création d'une instance de classe Patient
    $patient = new Patient();

    $patient->id = htmlspecialchars($_GET['id']);

    //récupération du profil Patient
    $patientProfile = $patient->getPatientProfile();

    if (!is_object($patientProfile)) {
        header('Location: ../views/exo2_listPatient.php');
        exit();
    }
} else {
    header('Location: ../views/exo2_listPatient.php');
    exit();
}
?>

