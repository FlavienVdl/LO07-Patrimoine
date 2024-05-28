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


}
?>
<!-- ----- fin ModelResidence -->