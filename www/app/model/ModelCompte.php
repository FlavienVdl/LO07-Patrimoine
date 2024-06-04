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

    // retourne une liste des comptes liés à une personne
    public static function getAllOfClient($login)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT compte.id, compte.label, compte.montant, banque.label AS banque_label, personne.nom, personne.prenom
                        FROM compte
                        JOIN banque ON compte.banque_id = banque.id
                        JOIN personne ON compte.personne_id = personne.id
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

    // insère un compte dans la base
    public static function insert($label, $montant, $banque_id, $personne_id)
    {
        $messages = array();
        try {
            $new_id = ModelCompte::getNewId();
            $database = Model::getInstance();
            // ajout d'un compte
            $query = "INSERT INTO compte (id, label, montant, banque_id, personne_id) VALUES (:id, :label, :montant, :banque_id, :personne_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $new_id,
                'label' => $label,
                'montant' => $montant,
                'banque_id' => $banque_id,
                'personne_id' => $personne_id
            ]);
            $messages[] = "Le compte a été ajouté";
        } catch (PDOException $e) {
            $messages[] = "Une erreur est survenue, le compte n'a pas été ajouté";
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        }
        return $messages;
    }

    // retourne un nouvel id pour un compte
    public static function getNewId()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT MAX(id) FROM compte";
            $statement = $database->query($query);
            $results = $statement->fetch();
            return $results[0] + 1;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    // retourne un compte à partir de son id
    public static function getCompteById($id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM compte WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    // transfert d'un montant d'un compte à un autre
    public static function transfert($compte, $compte2, $montant)
    {
        $messages = array();
        try { 
            $database = Model::getInstance();
            $database->beginTransaction();
            $query = "UPDATE compte SET montant = montant - :montant WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['montant' => $montant, 'id' => $compte['id']]);
            $query = "UPDATE compte SET montant = montant + :montant WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute(['montant' => $montant, 'id' => $compte2['id']]);
            $database->commit();
            $messages[] = "Le transfert a été effectué";
            $messages[] = "Le nouveau solde du compte " . $compte['label'] . " est de " . ($compte['montant'] - $montant);
            $messages[] = "Le nouveau solde du compte " . $compte2['label'] . " est de " . ($compte2['montant'] + $montant);

        } catch (PDOException $e) {
            $database->rollBack();
            $messages[] = "Une erreur est survenue, le transfert n'a pas été effectué";
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        }
        return $messages;
    }
}
?>
<!-- ----- fin ModelCompte -->