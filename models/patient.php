<?php

//Patient hérite de la classe Database
class Patient extends Database {

    public $id;
    public $lastname;
    public $firstname;
    public $birthdate;
    public $phone;
    public $mail;
    public $formErrors = array();

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function hasUniqueMail() {
//préparation de la requête
        $results = $this->db->prepare('SELECT `id`, `mail` FROM `patients` WHERE `mail` = :mail');

//association d'une valeur au marqueur nominatif
        $results->bindValue(':mail', $this->mail, PDO::PARAM_STR);

//éxecution de la requête
        try {
            $results->execute();
            $foundPatient = $results->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error :' . $e->getMessage());
        }

//tester la valeur $foundPatient
        if (is_object($foundPatient)) {
            return false;
        } else {
            return true;
        }
    }

    public function createPatient() {
//préparation de la requête
        $results = $this->db->prepare('INSERT INTO `patients` (
                `lastname`, `firstname`, `birthdate`, `phone`, `mail`
                ) VALUES (
                :lastname, :firstname, :birthdate, :phone, :mail        
                )');

//association d'une valeur à chaque marqueur nominatif
        $results->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $results->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $results->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $results->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $results->bindValue(':mail', $this->mail, PDO::PARAM_STR);

//éxecution de la requête
        try {
            return $results->execute();
        } catch (PDOException $e) {
            die('Error :' . $e->getMessage());
        }
    }

    public function getPatientList() {
        $results = $this->db->query('SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` FROM `patients`');
        return $results->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPatientProfile() {
        //méthode prepare() permet d'utiliser les marqueurs nominatifs et d'éviter l'injection de code SQL.
        //un profil en particulier, on met une condition à la fin ici WHERE id = :id.
        $results = $this->db->prepare('SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` WHERE `id` = :id');
        $results->bindValue(':id', $this->id, PDO::PARAM_INT);

        try {
            $results->execute();
            return $results->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error :' . $e->getMessage());
        }
    }

}

?>