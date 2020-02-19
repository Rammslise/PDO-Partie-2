<?php
//on démarre la session
session_start();

require_once '../init/functions.php';
require_once '../init/credentials.php';
require_once '../models/database.php';
require_once '../models/patient.php';
require_once '../controllers/exo4_editPatientCtrl.php';
include 'headerViews.php';
?>

<div class="formBody">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Exercice 4 - Consigne
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Depuis la page de profil d'un patient, permettre la modification de ce patient.                
                </div>
            </div>
        </div>
    </div>
    
    <!--Card avec formulaire d'inscription -->
    <div class="p-2">
        <div class="card text-center" style="width: 30rem;" id="registration">
            <div class="card-header" id="inscription">
                Formulaire de modification
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Modifier une fiche Patient</h5>

                <!--Début du formulaire -->
                <form method="POST" action="#">
                    <div class="form-row">
                        <div class="form-group col-md-6"> 
                            <label for="lastname">Votre Nom :</label>
                            <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Nom" value="<?= isset($profile->lastname) ? $profile->lastname : ''; ?>"/>
                            <small class="text-danger">
                                <?php
                                if (isset($profile->formErrors['lastname'])) {
                                    echo $profile->formErrors['lastname'];
                                }
                                ?>
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname">Votre Prénom :</label>
                            <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Prénom" value="<?= isset($profile->firstname) ? $profile->firstname : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($profile->formErrors['firstname'])) {
                                    echo $profile->formErrors['firstname'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="birthdate">Date de naissance :</label>
                            <input type="date" id="birthdate" class="form-control" name="birthdate" value="<?= isset($profile->birthdate) ? $profile->birthdate : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($profile->formErrors['birthdate'])) {
                                    echo $profile->formErrors['birthdate'];
                                }
                                ?>
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Numéro de téléphone :</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="0102030405" value="<?= isset($profile->phone) ? $profile->phone : ''; ?>" />
                            <small class="text-danger">
                                <?php
                                if (isset($profile->formErrors['phone'])) {
                                    echo $profile->formErrors['phone'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="card-body-center">
                        <label for="mail">Adresse Mail :</label>
                        <input type="text" id="mail" class="form-control" name="mail" placeholder="adresse@example.com" value="<?= isset($profile->mail) ? $profile->mail : ''; ?>" />
                        <small class="text-danger">
                            <?php
                            if (isset($profile->formErrors['mail'])) {
                                echo $profile->formErrors['mail'];
                            }
                            ?>
                        </small>
                    </div>
                    <div class="p-2">
                        <input type="hidden" name="id" value="<?= $profile->id ?>">
                        <p><input type="submit" name="submit" value="Enregistrer"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footerViews.php'; ?>