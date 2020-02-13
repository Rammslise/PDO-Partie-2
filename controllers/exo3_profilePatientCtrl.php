<?php

// isset = existe !!!!
if (isset($_GET['id']) && $_GET['id'] > 0) {
    //création d'une instance de classe Patient
    $patient = new Patient();

    $patient->id = htmlspecialchars($_GET['id']);

    //récupération du profil Patient
    $patientProfile = $patient->getPatientProfile();

    if (!is_object($patientProfile)) {
        header('Location: exo2_listPatient.php');
        exit();
    }
} else {
    header('Location: exo2_listPatient.php');
    exit();
}
?>

