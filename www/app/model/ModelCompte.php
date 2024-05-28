<!-- ----- debut ModelCompte -->

<?php
require_once 'Model.php';

class ModelCompte
{
    private $id, $label, $montant, $banque_id, $personne_id; //$personne, $banque;

    public function __construct($id = NULL, $label = NULL, $montant = NULL, $banque_id = NULL, $personne_id = NULL)
    {
        if (!is_null($id) && !is_null($label) && !is_null($montant) && !is_null($banque_id) && !is_null($personne_id)) {
            $this->id = $id;
            $this->label = $label;
            $this->montant = $montant;
            $this->banque_id = $banque_id;
            $this->personne_id = $personne_id;
        }
        // $this->personne = ModelPersonne::getPersonne($personne_id);
        // $this->banque = ModelBanque::getBanque($banque_id);
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

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function setBanqueId($banque_id)
    {
        $this->banque_id = $banque_id;
    }

    public function setPersonneId($personne_id)
    {
        $this->personne_id = $personne_id;
    }

    // public function setPersonne($personne)
    // {
    //     $this->personne = $personne;
    // }

    // public function setBanque($banque)
    // {
    //     $this->banque = $banque;
    // }

    //getter
    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getMontant()
    {
        return $this->montant;
    }


    public function getPersonneId()
    {
        return $this->personne_id;
    }
    
    public function getBanqueId()
    {
        return $this->banque_id;
    }

    // public function getPersonne()
    // {
    //     return $this->personne;
    // }

    // public function getBanque()
    // {
    //     return $this->banque;
    // }

    // retourne une liste de tous les comptes
    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT compte.id, compte.label, compte.montant, banque.label AS banque_label, personne.nom, personne.prenom
                      FROM compte
                      JOIN banque ON compte.banque_id = banque.id
                      JOIN personne ON compte.personne_id = personne.id";
            $statement = $database->query($query);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    

    // retourne une liste des comptes liés à une banque
    public static function getComptesByBanque($label)
{
    try {
        $database = Model::getInstance();
        $query = "SELECT compte.id, compte.label, compte.montant, banque.label AS banque_label, personne.nom, personne.prenom
                  FROM compte
                  JOIN banque ON compte.banque_id = banque.id
                  JOIN personne ON compte.personne_id = personne.id
                  WHERE banque.label = :label";
        $statement = $database->prepare($query);
        $statement->execute(['label' => $label]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}
}
?>
<!-- ----- fin ModelCompte -->