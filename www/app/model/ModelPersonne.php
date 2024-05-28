<!-- ----- debut ModelCompte -->

<?php
require_once 'Model.php';

class ModelPersonne {
    private $id, $nom, $prenom, $statut, $login, $password;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $statut = NULL, $login = NULL, $password = NULL) {
        if (!is_null($id) && !is_null($nom) && !is_null($prenom) && !is_null($statut) && !is_null($login) && !is_null($password)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->statut = $statut == 0 ? "admin" : "client";
            $this->login = $login;
            $this->password = $password;
        }
    }

    //setter
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    //getter

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // retourne la personne liée à un id
    public static function getPersonne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results[0];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // retourne une liste de tous les clients
    public static function getAllClient() {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where statut = 1";
            $statement = $database->query($query);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // retourne une liste de tous les admins
    public static function getAllAdmin() {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where statut = 0";
            $statement = $database->query($query);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelCompte -->