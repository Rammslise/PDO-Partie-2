<?php

//Patient hérite de la classe Database
class Patient extends Database {

    public $id;
    public $lastname;
    public $firstname;
    public $birthdate;
    public $phone;
    public $mail;
    // initialisation du tableau d'erreurs
    public $formErrors = array();

    /**
     * connexion à la base de données
     * le constructeur hérite du construct de la classe parente
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * fermeture automatique de la connexion à la destruction de l'instance de classe
     */
    public function __destruct() {
        parent::__destruct();
    }

    /**
     * méthode permettant d'inscrire un nouveau patient dans la BDD
     * @return boolean
     */
    public function createPatient() {
        //definition de la requete SQL avec des marqueurs nommés
        $query = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`
                        ) VALUES (
                        :lastname, :firstname, :birthdate, :phone, :mail)";

// preparation de la requete au serveur de bdd
        $results = $this->db->prepare($query);

// association des marqueurs nommées aux véritables informations
        $results->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $results->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $results->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $results->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $results->bindValue(':mail', $this->mail, PDO::PARAM_STR);

//éxecution de la requête
        try {

            // execution de la requete
            // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode addPatient(ctrl)
            return $results->execute();
        }
        //bloc catch de renvoi des erreurs
        catch (PDOException $e) {
            die('Error :' . $e->getMessage());
        }
    }

    /**
     * méthode permettant de récupérer la liste de tous les patients
     * @return array
     */
    public function getPatientList() {
        //definition de la requete SQL 
        $query = 'SELECT `id`, 
                                     `lastname`, 
                                     `firstname`, 
                                     `birthdate`, 
                                     DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdateFR`, 
                                     `phone`, 
                                     `mail` 
                        FROM `patients`';                       ;

        // soumission de la requete au serveur de bdd
        $results = $this->db->query($query);

        // recuperation de la liste des clients sous forme d'un tableau d'objets
        return $results->fetchAll(PDO::FETCH_OBJ);
    }

     /**
     * méthode permettant de vérifier si un mail est déjà existant
     * @return booléen
     */
    public function hasUniqueMail() {

        //definition de la requete SQL
        $query = 'SELECT `id`, 
                                     `mail`    
                        FROM `patients` 
                        WHERE `mail`= :mail';

        // preparation de la requete au serveur de bdd
        $results = $this->db->prepare($query);

        // association des marqueurs nommées aux véritables informations
        $results->bindValue(':mail', $this->mail, PDO::PARAM_STR);

        try {
            $results->execute();

            // recuperation du premier email correspondant trouvé dans un objet
            $check = $results->fetch(PDO::FETCH_OBJ);

            // verification que le mail existe deja ET appartient à un autre patient
            if (is_object($check) && $check->id !== $this->id) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            die('erreur : ' . $e->getMessage());
        }
    }

    /**
     * méthode permettant de récupérer le profil d'un patient
     * @return array
     */
    public function getPatientProfile() {

        // définition de la requête sql
        $query = 'SELECT  `id`,
                                     `lastname`,            
                                     `firstname`, 
                                     `birthdate`,
                                     DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdateFR`, 
                                     `phone`, 
                                     `mail` 
                        FROM `patients`
                        WHERE `id`= :id';
                       
        //méthode prepare() permet d'utiliser les marqueurs nominatifs et d'éviter l'injection de code SQL.
        //un profil en particulier, on met une condition à la fin ici WHERE id = :id.
        $results = $this->db->prepare($query);
        $results->bindValue(':id', $this->id, PDO::PARAM_INT);

        try {
            $results->execute();
            return $results->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Error :' . $e->getMessage());
        }
    }

    /**
     * méthode permettant de modifier le profil d'un patient
     * @return boolean
     */
    public function editPatientProfile() {
        try {
            $query = 'UPDATE `patients` 
                               SET        `lastname` = :lastname, 
                                             `firstname` = :firstname, 
                                             `birthdate` = :birthdate, 
                                             `phone` = :phone, 
                                             `mail` = :mail 
                               WHERE `id` = :id';
            $results = $this->db->prepare($query);
            $results->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $results->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $results->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
            $results->bindValue(':phone', $this->phone, PDO::PARAM_STR);
            $results->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $results->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $results->execute();
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    /**
     * méthode permettant de récupérer l'id d'un patient grace à son e-mail
     * @return integer
     */
    public function getPatientByMail() {
        try {
            // définition de la requête sql
            $query = 'SELECT `id`
                             FROM `patients` 
                             WHERE `mail` = :mail';

            // soumission de la requête au serveur de la base de données
            $results = $this->db->prepare($query);

            // association des marqueurs nommés aux véritables informations
            $results->bindValue(':mail', $this->mail, PDO::PARAM_STR);

            $results->execute();

            // récupération de l'id du patient correspndant au mail renseigné 
            // sous forme d'un objet
            return $results->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('erreur : ' . $e->getMessage());
        }
    }
    
        /**
     * méthode permettant de supprimer un patient
     * @return boolean
     */
    public function deletePatient() {
        try {
            $query = 'DELETE FROM `patients`
                            WHERE id = :id                            
                            LIMIT 1';
            $results = $this->db->prepare($query);
            $results->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $results->execute();
        } catch (PDOException $e) {
            echo 'Connexion echoué : ' . $e->getMessage();
        }
    }

}

?>