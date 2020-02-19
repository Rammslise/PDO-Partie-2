<?php
//on démarre la session
session_start();

require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../models/appointment.php';
require_once '../controllers/exo7_getAppointmentCtrl.php';
include 'headerViews.php';
?>

<!--Succès de la modification -->
<?php if (isset($message)) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message ?>
    </div>
<?php } ?>

<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 7 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Créer la page rendezvous.php. Elle doit permettre d'afficher toutes les informations d'un rendez-vous. Elle doit être accessible depuis la page liste-rendezvous.php et afficher les informations du rendez-vous sélectionné.            
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card border-secondary mt-2 mb-2 p-2" style="max-width: 27rem;">
                <div class="card-header">Fiche de rendez-vous <a class="btn btn-info col-4" type="submit" name="submit" id="modify" href="exo8_editAppointment.php?id=<?= $appointmentInfo->id ?>">Modifier</a></div>
                <div class="card-body text-secondary">
                    <p class="h2 card-title"><?= $appointmentInfo->lastname . ' ' . $appointmentInfo->firstname ?></p>
                </div>
                <p class="ml-3">Rendez-vous le : <?= $appointmentInfo->dateHour ?></p>          
            </div>           
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>