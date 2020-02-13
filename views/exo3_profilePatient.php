<?php
//on démarre la session
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../controllers/exo3_profilePatientCtrl.php';
include 'headerViews.php';
include 'navbarViews.php';
?>
<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 3 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Créer une page profil-patient.php. Elle doit permettre d'afficher toutes les informations d'un patient. Elle doit être accessible depuis la page liste-patients.php et afficher les informations du patient sélectionné.
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card border-secondary mt-2 mb-2 p-2" style="max-width: 27rem;">
                <div class="card-header">Fiche Patient <a class="btn btn-info col-4" type="submit" name="submit" id="modify" href="">Modifier</a></div>
                <div class="card-body text-secondary">
                    <p class="h2 card-title"><?= $patientProfile->lastname . ' ' . $patientProfile->firstname ?></p>
                </div>
                <h5>Date de naissance : <?= $patientProfile->birthdate ?></h5>
                <h5>Numéro de téléphone : <?= $patientProfile->phone ?></h5>
                <h5>Adresse Mail : <?= $patientProfile->mail ?></h5>             
            </div>           
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>