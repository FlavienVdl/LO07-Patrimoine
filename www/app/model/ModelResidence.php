<!-- ----- debut ModelResidence -->

<?php
require_once 'Model.php';

class ModelResidence
{
    private $id, $label, $ville, $prix, $personne_id; //$personne, $banque;

    public function __construct($id = NULL, $label = NULL, $ville = NULL, $prix = NULL, $personne_id = NULL)
    {
        if (!is_null($id) && !is_null($label) && !is_null($ville) && !is_null($prix) && !is_null($personne_id)) {
            $this->id = $id;
            $this->label = $label;
            $this->ville = $ville;
            $this->prix = $prix;
            $this->personne_id = $personne_id;
        }
    }

    //setter
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function setPersonneId($personne_id)
    {
        $this->personne_id = $personne_id;
    }

    //getter

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getPersonneId()
    {
        return $this->personne_id;
    }

    // retourne une liste de tous les comptes
    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT residence.id, residence.label, residence.ville, residence.prix, personne.nom, personne.prenom
                  FROM residence
                  JOIN personne ON residence.personne_id = personne.id";
            $statement = $database->query($query);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getAllOfClient($login)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT residence.id, residence.label, residence.ville, residence.prix, personne.nom, personne.prenom
                  FROM residence
                  JOIN personne ON residence.personne_id = personne.id
                  WHERE personne.login = :login";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $login]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getResidenceByLabel($label){
        try {
            $database = Model::getInstance();
            $query = "SELECT residence.id, residence.label, residence.ville, residence.prix, personne.nom, personne.prenom, residence.personne_id
                  FROM residence
                  JOIN personne ON residence.personne_id = personne.id
                  WHERE residence.label = :label";
            $statement = $database->prepare($query);
            $statement->execute(['label' => $label]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results[0];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getResidencePersonneIdByLabel($label){
        try {
            $database = Model::getInstance();
            $query = "SELECT personne_id
                  FROM residence
                  WHERE label = :label";
            $statement = $database->prepare($query);
            $statement->execute(['label' => $label]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results[0]['personne_id'];
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    // retourne une liste de toutes les residences sans celles de la personne connectée
    public static function getAllWithoutAcheteur(){
        try {
            $database = Model::getInstance();
            $query = "SELECT residence.id, residence.label, residence.ville, residence.prix, personne.nom, personne.prenom
                  FROM residence
                  JOIN personne ON residence.personne_id = personne.id
                  WHERE residence.personne_id != (SELECT id FROM personne WHERE login = :login)";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $_SESSION['login']]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    // Change le propriétaire de la résidence
    public static function updatePersonneId($personne_id, $residence_id){
        try {
            $database = Model::getInstance();
            $query = "UPDATE residence SET personne_id = :personne_id WHERE id= :residence_id";
            $statement = $database->prepare($query);
            $statement->execute(['personne_id' => $personne_id, 'residence_id' => $residence_id]);
            return "Transaction réussie";
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return "Transaction échouée";
        }
    }

    // retourne une liste de toutes les residences en fonction des paramètres
    public static function getResidence($nom, $lieu, $prixMin, $prixMax){
        try {
            $database = Model::getInstance();
            $chaine = "SELECT residence.id, residence.label, residence.ville, residence.prix, personne.nom, personne.prenom
                  FROM residence
                  JOIN personne ON residence.personne_id = personne.id WHERE";
            if ($nom != "") {
                $chaine = $chaine . " residence.label like '%" . $nom . "%' AND";
            }
            if ($lieu != "") {
                $chaine = $chaine . " residence.ville like '%" . $lieu . "%' AND";
            }
            if ($prixMin != "") {
                $chaine = $chaine . " residence.prix >= " . $prixMin . " AND";
            }
            if ($prixMax != "") {
                $chaine = $chaine . " residence.prix <= " . $prixMax . " AND";
            }
            $chaine = $chaine . " 1=1";
            $statement = $database->query($chaine);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
?>
<!-- ----- fin ModelResidence -->