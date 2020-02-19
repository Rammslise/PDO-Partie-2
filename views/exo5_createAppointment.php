<?php
//on démarre la session
session_start();

require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/appointment.php';
require_once '../models/patient.php';
require_once '../controllers/exo5_createAppointmentCtrl.php';
include 'headerViews.php';
?>

<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 5 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Créer une page ajout-rendezvous.php et y créer un formulaire permettant de créer un rendez-vous. Elle doit être accessible depuis la page index.php.                
                </div>
            </div>
        </div>
    </div>
    
    <!--Card avec formulaire de prise de rdv -->
    <div class="p-2">
        <div class="card text-center" style="width: 30rem;" id="registration">
            <div class="card-header" id="inscription">
                Prise de rendez-vous
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Nouveau Rendez-vous</h5>

                <!-- Balise FORM avec méthode POST pour récupérer les infos des champs-->
                <form method="POST" action="#">

                    <!-- Champs de renseignement de la date-->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date">Date :</label>
                            <input type="date" id="appointmentDate" class="form-control" name="date" value="<?= isset($appointment->date) ? $appointment->date : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($appointment->formErrors['date'])) {
                                    echo $appointment->formErrors['date'];
                                }
                                ?>
                            </small>
                        </div>
                        <!-- Champs de renseignement de l'heure-->
                        <div class="form-group col-md-6">
                            <label for="hour">Heure :</label>
                            <input type="time" id="hour" class="form-control" name="hour"  value="<?= isset($appointment->time) ? $appointment->time : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($appointment->formErrors['hour'])) {
                                    echo $appointment->formErrors['hour'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <!-- Champs de renseignement du mail-->
                    <div class="card-body-center">
                        <label for="mail">Adresse Mail :</label>
                        <input type="text" id="mail" class="form-control" name="mail" placeholder="adresse@example.com" value="<?= isset($profile->mail) ? $profile->mail : ''; ?>" />
                        <small class="text-danger">
                            <?php
                            if (isset($patient->formErrors['mail'])) {
                                echo $patient->formErrors['mail'];
                            }   
                            ?>
                        </small>
                    </div>
                    <!-- Bouton de validation du formulaire-->
                    <div class="p-2">
                        <button class="btn btn-info" type="submit" name="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>