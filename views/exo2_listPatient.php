<?php
//on démarre la session
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../controllers/exo2_listPatientCtrl.php';
include 'headerViews.php';
?>
<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 2 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Créer une page liste-patients.php et y afficher la liste des patients. Inclure dans la page, un lien vers la création de patients.
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
            <h2 class="text-center" style="color: white">Liste des clients</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">Numéro de téléphone</th>
                        <th scope="col">Adresse Mail</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($patientList as $patient) { ?>
                        <tr>
                            <td>
                                <?= $patient->id ?>
                            </td>
                            <td>
                                <?= $patient->lastname ?>
                            </td>
                            <td>
                                <?= $patient->firstname ?>
                            </td>
                            <td>
                                <?= $patient->birthdateFR ?>                               
                            </td>
                            <td>
                                <?= $patient->phone ?>
                            </td>
                            <td>                         
                                <?= $patient->mail ?>   
                            </td>
                            <td class="col-5">
                                <a class="btn btn-info" href="exo3_profilePatient.php?id=<?= $patient->id ?>">Profil</a>
                                <a class="btn btn-info" href="exo1_createPatient.php">Création</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-<?= $patient->id ?>">
                                    Supprimer
                                </button>     
                                <!-- Modal -->
                                <div class="modal fade" id="modal-<?= $patient->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a class="btn btn-primary" href="exo11_deletePatient.php?id=<?= $patient->id ?>">Confirmer</a>
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