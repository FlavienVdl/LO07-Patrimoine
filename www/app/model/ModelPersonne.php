<!-- ----- debut ModelPersonne -->

<?php
require_once 'Model.php';

class ModelPersonne
{
    private $id, $nom, $prenom, $statut, $login, $password;

    public const ADMINISTRATEUR = 0;
    public const CLIENT = 1;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $statut = NULL, $login = NULL, $password = NULL)
    {
        if (!is_null($id) && !is_null($nom) && !is_null($prenom) && !is_null($statut) && !is_null($login) && !is_null($password)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->statut = $statut;
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
    public static function getPersonne($id)
    {
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
    public static function getAllClient()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where statut = :statut";
            $statement = $database->prepare($query);
            $statement->execute(['statut' => ModelPersonne::CLIENT]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // retourne une liste de tous les admins
    public static function getAllAdmin()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where statut = :statut";
            $statement = $database->prepare($query);
            $statement->execute(['statut' => ModelPersonne::ADMINISTRATEUR]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // insère une nouvelle personne
    public static function insert($nom, $prenom, $login, $password)
    {
        try {
            $database = Model::getInstance();
            if (!$database) {
                throw new PDOException("Échec de la connexion à la base de données");
            }

            $id = self::getNewId();
            if (is_null($id)) {
                throw new PDOException("Échec de la génération d'un nouvel ID");
            }

            $query = "insert into personne(id, nom, prenom, statut, login, password) values (:id, :nom, :prenom, 1, :login, :password)";
            $statement = $database->prepare($query);
            $success = $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $login,
                'password' => $password
            ]);

            if ($success) {
                return true;
            } else {
                $errorInfo = $statement->errorInfo();
                throw new PDOException("Erreur d'insertion : " . $errorInfo[2]);
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }


    // renvoie un nouvel id
    public static function getNewId()
    {
        try {
            $database = Model::getInstance();
            $query = "select max(id) from personne";
            $statement = $database->query($query);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results[0] + 1;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // renvoie la personne correspondant à un login et un mot de passe
    public static function connexion($login, $password)
    {
        try {
            $database = Model::getInstance();
            $query = "select statut from personne where login = :login and password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login,
                'password' => $password
            ]);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            if (count($results) > 0) {
                return $results[0];
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getPersonneByLogin($login)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from personne where login = :login";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $login]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            if (count($results)>0) {
                return $results[0];
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelPersonne -->