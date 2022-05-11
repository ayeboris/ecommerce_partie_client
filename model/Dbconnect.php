<?php
// namespace model\PDO;

class Dbconnect{
    private $pdo;
    public function __construct()
    {
        $this->pdo=null;
    }


    
    public function connect(){
        // TODO  Fichier de configuration a la BD
        // pour oracle: $dsn="oci:dbname=//serveur:1521/base
        // pour sqlite: $dsn="sqlite:/tmp/base.sqlite";
        //$dsn="mysql:dbname=".BASE.";host=".SERVER;//Conf on mysql

        $dsn="mysql:host=localhost;dbname=ecommerce_voiture;charset=utf8";
        $usernme='root';
        $password='';

        try {
            $this->pdo=new PDO($dsn,$usernme,$password);
            /**
             *
            PDO::NULL_NATURAL: No conversion.
            PDO::NULL_EMPTY_STRING: Empty stringis converted to NULL.
            PDO::NULL_TO_STRING: NULL is converted to an empty string.
             */
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
            die();
        }

        return $this->pdo;
    }

    /**
     * @return mixed    FONCTION POUR SE CONNECTER A LA BD DISTANTE
     */
    public static function connectDistante(){
        // TODO  Fichier de configuration a la BD
        // pour oracle: $dsn="oci:dbname=//serveur:1521/base
        // pour sqlite: $dsn="sqlite:/tmp/base.sqlite";
        //$dsn="mysql:dbname=".BASE.";host=".SERVER;//Conf on mysql


        $dsn="mysql:host=localhost;dbname=ecommerce_voiture;charset=utf8";
        $usernme='root';
        $password='';

        try {
            $pdo2=new PDO($dsn,$usernme,$password);
            $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
            die();
        }

        return $pdo2;
    }

    
}

