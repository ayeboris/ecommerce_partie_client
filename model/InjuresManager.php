<?php


// use \model\PDO\Dbconnect;
class InjuresManager extends Manager
{

    /**
     * @param mixed ...$parametres Parametre sous forme : ( "CLE1=>VALEUR,CLE2=>VALEUR" )
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `injures`(`LIBELLE`)  VALUES (?) ";
        return Manager::req($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req="UPDATE `injures` SET `LIBELLE`=? WHERE ID=? ";      
        return Manager::reqOne($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     */
    function afficherTout()
    {
        $req="SELECT `LIBELLE` FROM `injures` ";
        return Manager::req($req);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient
     */
    function afficherUn(...$parametres)
    {
        $req="SELECT `ID`, `LIBELLE` FROM `injures` WHERE ID=?  ";
        return Manager::req($req,...$parametres);
    }

    /**
     * @param $parametres   Identifient pour la suppression
     * @return mixed    Supprimer un element
     */
    function supprimer($parametres){
        $req="DELETE FROM injures WHERE ID=? ";
        return Manager::req($req,...$parametres);
    }

}
