<?php
session_start();

require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../models/appointment.php';
require_once '../controllers/exo9_showAppointmentCtrl.php';
include 'headerViews.php';
?>

<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 9 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Sur la page profil du patient, afficher sous ses informations la liste de ses rendez-vous.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-2">
            <h2 class="text-center" style="color: white">Liste des rendez-vous</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table">
                <thead class="thead-dark">
                    <tr>                     
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Adresse Mail</th>
                        <th scope="col">Rendez-vous</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td>
                            <?= $patientProfile->lastname ?>
                        </td>
                        <td>
                            <?= $patientProfile->firstname ?>
                        </td>
                        <td>
                            <?= $patientProfile->mail ?>   
                        </td>
                        <td>                       
                            <ul class="pl-0">
                                <?php foreach ($appointmentInfo as $infos) { ?>
                                    <li><?= $infos->dateHour ?></li>
                                <?php } ?>                 
                            </ul>                          
                        </td>
                        <td>
                            <a class="btn btn-info" href="exo3_profilePatient.php?id=<?= $patientProfile->id ?>">Profil</a>
                            <a class="btn btn-info"  href="exo1_createPatient.php">Création</a>
                            <a class="btn btn-info"  href="exo8_editAppointment.php?id=<?= $infos->id ?>">Modification</a>
                            <a class="btn btn-danger"  href="exo11_deletePatient.php?id=<?= $patientProfile->id ?>">Supprimer</a>
                        </td>
                    </tr>
                </tbody>
            </table>               
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>