<?php
//création de la classe database
class Database{
  //visibilité private, se restreint au contexte de la classe ici 'database'.
  private $host = HOSTNAME;
  private $dbname = DBNAME;
  private $username = USERNAME;
  private $password = PASSWORD;

  //visibilité protected : l'attribut est accessible depuis la classe et les classes qui en hérite.
  protected $db;

  // visibilité public : l'attribut est accessible depuis la classe elle-même, les classes qui en hérite et depuis l'extérieur des classes.
  public function __construct(){
    try{
      //création instance de connection
      $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //récupère l'erreur
    } catch (PDOException $e) {
      die('Error :' . $e->getMessage());
    }
  }
  public function __destruct(){
    //ferme automatiquement la connexion à la base de données
    $this->db = null;
  }
}
?>
