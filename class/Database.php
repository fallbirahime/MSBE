<?php

class Database
{

    private $pdo;

    public function __construct($login, $password, $dbname, $host = 'localhost'  )
    {
        try{
            $this->pdo = new PDO("mysql:dbname=$dbname;host=$host",$login,$password);

        }catch (Exception $ex) {
            var_dump('erreur de connexion');
        }

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * @param $query
     * @param bool|array $params
     * @return PDOStatement
     */
    public function query($query, $params = false)
    {
        if ($params) {
            $requete = $this->pdo->prepare($query);

            $requete->execute($params);
        }
        else {
            try {

                $requete = $this->pdo->query($query);
            }catch (PDOException $ex){
                echo $ex;
            }
        }
        return $requete;

    }
}