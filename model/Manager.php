<?php

require_once('Dbconnect.php');
// use \model\PDO\Dbconnect;
class Manager extends Dbconnect
{
    /**
     * @param $req  C'est la requete mere pour la communication a la BD
     * @param mixed ...$parametre Ces sont les parametres complementaire pour notre requete a la BD
     * Exemple utilisation: $parametre[indice]=InfoParametre1,$parametre[indice]=InfoParametre2
     * @return mixed    Retoure une information sous forme de tableau d'info
     */
     public static function req($req, ...$parametre)
    {

        $pdo =(new Dbconnect)->connect();
        $prepare = $pdo->prepare($req);

        if($parametre != null ){
            $prepare->execute($parametre);
        }else{
            $prepare->execute();
        }


        $result = $prepare->fetchAll();

        return $result;
    }

    public static function reqOne($req, ...$parametre)
    {

        $pdo =(new Dbconnect)->connect();

        $prepare = $pdo->prepare($req);

        if($parametre != null ){
            $prepare->execute($parametre);
        }else{
            $prepare->execute();
        }


        $result = $prepare->fetch();

        return $result;
    }

    public static function reqAction($req, ...$parametre)
    {

        $pdo =(new Dbconnect)->connect();

        $prepare = $pdo->prepare($req);

        if($parametre != null ){
            $prepare->execute($parametre);
        }else{
            $prepare->execute();
        }


        $result = $prepare;

        return $result;
    }

    /**
     * @param $table    La table dans la BD
     * @param $champ    Le champs dans la table
     * @return mixed    Retourne la derniere valeur d'un champs specifie pour une table
     */
    public static function LastId($table,$champ)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
        $pdo=(new Dbconnect)->connect();
        $prepare = $pdo->prepare("SELECT max($champ) as val FROM $table");
        $result="";
        if($prepare->execute()){
            $result=$prepare->fetch();
        }
        $lastId = $result['val'];
        return $lastId;
    }

}
