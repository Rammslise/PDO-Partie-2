<?php
// Condition qui permet de vérifier les parametres d'URL
if (isset($_GET['id']) && $_GET['id'] > 0){

    //  création d'une nouvelle instance de classe Appointment()
    $patient = new Patient();
    $patient->id = htmlspecialchars($_GET['id']);

    // On appelle la methode deleteAppointment()
    // Suppression du rdv
    $success = $patient->deletePatient();

    if ($success) {

        // création du message de confirmation 
        $_SESSION['message'] = 'Le patient a bien été supprimé';

        // Spécifique au header(Location) le exit permet d'arreter la requête 
        // Chemin relatif
        header('Location: ../views/exo2_listPatient.php');
        exit();
    }
} else {
    // Le else permet de renvoyer l'utilisateur si il y a autre chose qu'un type int
    header('Location: ../views/exo2_listPatient.php');
    exit();
}
?>

