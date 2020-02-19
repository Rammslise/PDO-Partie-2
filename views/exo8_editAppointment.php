<?php
//on démarre la session
session_start();

require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../models/appointment.php';
require_once '../controllers/exo8_editAppointmentCtrl.php';
include 'headerViews.php';
?>

<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 8 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Depuis la page d'un rendez-vous, permettre la modification de ce rendez-vous.          
                </div>
            </div>
        </div>
    </div>


    <!--Card avec formulaire de modification-->
    <div class="p-2">
        <div class="card text-center" style="width: 30rem;" id="registration">
            <div class="card-header" id="inscription">
                Formulaire de modification
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Modifier votre rendez-vous</h5>

                <!--Début du formulaire -->
                <form method="POST" action="#">
                    <div class="form-row">
                        <div class="form-group col-md-6"> 
                            <label for="date">Date :</label>
                            <input type="date" id="date" class="form-control" name="date" value="<?= isset($appointment->date) ? $appointment->date : ''; ?>"/>
                            <small class="text-danger">
                                <?php
                                if (isset($appointment->formErrors['date'])) {
                                    echo $appointment->formErrors['date'];
                                }
                                ?>
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hour">Heure :</label>
                            <input type="time" id="hour" class="form-control" name="hour"  value="<?= isset($appointment->hour) ? $appointment->hour : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($appointment->formErrors['hour'])) {
                                    echo $appointment->formErrors['hour'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>            
                    <div class="p-2">
                        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
                        <p><input type="submit" name="submit" value="Enregistrer"></p>
                    </div>
                </form>
                <input type="hidden" name="id" value="<?= $appointment->id ?>">
            </div>
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>