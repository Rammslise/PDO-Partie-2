<?php
//on démarre la session
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../controllers/exo2_listPatientCtrl.php';
include 'headerViews.php';
include 'navbarViews.php';
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
                                <?= $patient->birthdate ?>
                            </td>
                            <td>
                                <?= $patient->phone ?>
                            </td>
                            <td>
                                <div class="container">
                                    <?= $patient->mail ?>                               
                                    <a class="btn btn-info col-3" type="submit" name="submit" href="exo3_profilePatient.php?id=<?= $patient->id ?>">Profil</a>
                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="p-2 text-center">
                <a class="btn btn-info" type="submit" name="submit" href="exo1_createPatient.php">Création</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footerViews.php'; ?>