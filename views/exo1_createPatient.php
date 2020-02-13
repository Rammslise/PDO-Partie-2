<?php
//on démarre la session
session_start();
require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../controllers/exo1_createPatientCtrl.php';
include 'headerViews.php';
include 'navbarViews.php';
?>
<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 1 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Créer une page ajout-patient.php et y créer un formulaire permettant de créer un patient. Elle doit être accessible depuis la page index.php.
                </div>
            </div>
        </div>
    </div>

    <!--Card avec formulaire d'inscription -->
    <div class="p-2">
        <div class="card text-center" style="width: 30rem;" id="registration">
            <div class="card-header" id="inscription">
                Formulaire d'inscription
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Nouveau Patient</h5>

                <!--Début du formulaire -->
                <form method="POST" action="#">
                    <div class="form-row">
                        <div class="form-group col-md-6"> 
                            <label for="lastname">Votre Nom :</label>
                            <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Nom" value="<?= isset($patient->lastname) ? $patient->lastname : ''; ?>"/>
                            <small class="text-danger">
                                <?php
                                if (isset($patient->formErrors['lastname'])) {
                                    echo $patient->formErrors['lastname'];
                                }
                                ?>
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname">Votre Prénom :</label>
                            <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Prénom" value="<?= isset($patient->firstname) ? $patient->firstname : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($patient->formErrors['firstname'])) {
                                    echo $patient->formErrors['firstname'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="birthdate">Date de naissance :</label>
                            <input type="date" id="birthdate" class="form-control" name="birthdate" value="<?= isset($patient->birthdate) ? $patient->birthdate : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($patient->formErrors['birthdate'])) {
                                    echo $patient->formErrors['birthdate'];
                                }
                                ?>
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Numéro de téléphone :</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="0102030405" value="<?= isset($patient->phone) ? $patient->phone : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($patient->formErrors['phone'])) {
                                    echo $patient->formErrors['phone'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="card-body-center">
                        <label for="mail">Adresse Mail :</label>
                        <input type="text" id="mail" class="form-control" name="mail" placeholder="adresse@example.com" value="<?= isset($patient->mail) ? $patient->mail : ''; ?>" />
                        <small class="text-danger">
                            <?php
                            if (isset($patient->formErrors['mail'])) {
                                echo $patient->formErrors['mail'];
                            }
                            ?>
                        </small>
                    </div>
                    <div class="p-2">
                        <button class="btn btn-info" type="submit" name="submit">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>