<?php

class Appointment extends Database {

    public $id;
    public $dateHour;
    public $idPatients;
// initialisation du tableau d'erreurs
    public $formErrors = array();

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    /**
     * méthode permettant de créer un nouveau rendez-vous dans la BDD
     * @return boolean
     */
    public function createAppointment() {

        try {
            //definition de la requete SQL avec des marqueurs nommés
            $query = "INSERT INTO `appointments` (`dateHour`, `idPatients`)
                  VALUES
                  (:dateHour, :idPatients)";


            // preparation de la requete au serveur de bdd
            $results = $this->db->prepare($query);

            // association des marqueurs nommées aux véritables informations
            $results->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
            $results->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);


            // execution de la requete
            // renvoi TRUE en cas de succès sinon FALSE là où j'appelle ma méthode addPatient(ctrl)
            return $results->execute();
        }
        //bloc catch de renvoi des erreurs
        catch (PDOException $e) {
            die('echec de la connexion : ' . $e->getMessage());
        }
    }

    /**
     * méthode permettant de vérifier si un rdv n'a pas les mêmes horaires
     * @return boolean
     */
    public function hasUniqueTimeSlot() {

        //definition de la requete SQL
        $query = 'SELECT `id`,
                                     `dateHour`
                        FROM `appointments` 
                        WHERE `dateHour`= :dateHour';

        // preparation de la requete au serveur de bdd
        $results = $this->db->prepare($query);

        // association des marqueurs nommées aux véritables informations
        $results->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);

        //soumission de la requête en bdd
        try {
            $results->execute();

            // recuperation du premier email correspondant trouvé dans un objet
            $foundTimeSlot = $results->fetch(PDO::FETCH_OBJ);

            // verification que l'horaire existe deja ET appartient à un autre patient
            if (is_object($foundTimeSlot) && $foundTimeSlot->id !== $this->id) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die('erreur : ' . $e->getMessage());
        }
    }

    /**
     * méthode permettant de récupérer la liste de tous les rendez-vous
     * @return array
     */
    public function getAppointmentList() {
        //definition de la requete SQL 
        $query = 'SELECT     `appointments`.`id`, 
                                         `appointments`.`dateHour`, 
                            DATE_FORMAT(`dateHour`, "%d/%m/%Y à %H: %i") AS `dateHour`,
                                         `appointments`. `idPatients`,
                                         `patients`.`lastname`,
                                         `patients`.`firstname`
                            FROM    `appointments`
                            INNER JOIN `patients`
                        ON `patients`.`id` = `appointments`.`idPatients`
                        WHERE `appointments`.`id`
                        ORDER BY `dateHour`';

        // soumission de la requete au serveur de bdd
        $results = $this->db->query($query);

        // recuperation de la liste des rendez-vous sous forme d'un tableau d'objets
        return $results->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * méthode permettant de récupérer les informations d'un rendez-vous
     * @return array
     */
    public function getAppointmentInfo() {

        // définition de la requête sql
        $query = 'SELECT   `appointments`.`id`, 
                            DATE_FORMAT(`dateHour`, "%d/%m/%Y à %H: %i") AS `dateHour`,
                                       `patients`.`lastname`,
                                       `patients`.`firstname`,
                                       `patients`.`mail`
                            FROM  `appointments`
                            INNER JOIN `patients`
                            ON `patients`.`id` = `appointments`.`idPatients`
                            WHERE `appointments`.`id` = :id';


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
     * méthode permettant de modifier un rendez-vous
     * @return boolean
     */
    public function editAppointmentInfo() {
        try {
            $query = 'UPDATE `appointments` 
                               SET        `dateHour` = :dateHour                                             
                               WHERE `id` = :id';
            $results = $this->db->prepare($query);
            $results->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
            $results->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $results->execute();
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    /**
     * méthode permettant d'afficher les rendez-vous d'un patient
     * @return array
     */
    public function showAppointment() {
        try {

            $query = 'SELECT `id`,                                     
                                     DATE_FORMAT(`dateHour`, "%d/%m/%Y à %H: %i") AS `dateHour`
                        FROM   `appointments` 
                        WHERE `idPatients` = :id';
            $results = $this->db->prepare($query);
            $results->bindValue(':id', $this->idPatients, PDO::PARAM_INT);
            $results->execute();
            return $results->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Connexion echoué : ' . $e->getMessage();
        }
    }

    /**
     * méthode permettant de supprimer un rdv
     * @return boolean
     */
    public function deleteAppointment() {
        try {
            $query = 'DELETE FROM `appointments`
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

