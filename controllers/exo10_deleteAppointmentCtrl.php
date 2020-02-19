<?php

// Condition qui permet de vérifier les parametres d'URL
if (isset($_GET['id']) && $_GET['id'] > 0){

    //  création d'une nouvelle instance de classe Appointment()
    $appointment = new Appointment();
    $appointment->id = htmlspecialchars($_GET['id']);
    
    // On appelle la methode deleteAppointment()
    // Suppression du rdv
    $success = $appointment->deleteAppointment();

    if ($success) {

        // création du message de confirmation 
        $_SESSION['message'] = 'Le rendez-vous a bien été supprimé';

        // Spécifique au header(Location) le exit permet d'arreter la requête 
        // Chemin relatif
        header('Location: ../views/exo6_listAppointment.php');
        exit();
    }
} else {
    // Le else permet de renvoyer l'utilisateur si il y a autre chose qu'un type int
    header('Location: ../views/exo6_listAppointment.php');
    exit();
}
?>