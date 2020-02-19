<?php
//on démarre la session
session_start();

require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../models/appointment.php';
require_once '../controllers/exo6_listAppointmentCtrl.php';
include 'headerViews.php';
?>

<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 6 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Dans la page liste-rendezvous.php, afficher la liste des rendez-vous. Inclure dans la page, un lien vers la création de rendez-vous.
                </div>
            </div>
        </div>
    </div>

    <!--Succès de la création -->
    <?php if (isset($message)) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message ?>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-12 mt-2">
            <h2 class="text-center" style="color: white">Liste des rendez-vous</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-7">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Date - Heure</th>
                        <th scope="col">Nom du Patient</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($appointmentList as $appointment) { ?>
                        <tr>
                            <td>
                                <?= $appointment->dateHour ?>
                            </td>
                            <td>                              
                                <?= $appointment->lastname . ' ' . $appointment->firstname ?>
                            </td>
                            <td>
                                <a class="btn btn-info"  href="exo7_getAppointment.php?id=<?= $appointment->id ?>">Infos</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-<?= $appointment->id ?>">
                                    Supprimer
                                </button>     
                                <!-- Modal -->
                                <div class="modal fade" id="modal-<?= $appointment->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer votre rendez-vous ?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <a class="btn btn-primary" href="exo10_deleteAppointment.php?id=<?= $appointment->id ?>">Confirmer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>
