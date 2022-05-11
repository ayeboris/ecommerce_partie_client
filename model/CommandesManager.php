<?php


// use \model\PDO\Dbconnect;
class CommandesManager extends Manager
{
    /**
     * @param mixed ...$parametres Parametre sous forme : ( "CLE1=>VALEUR,CLE2=>VALEUR" )
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `commandes`(`CODECL`, `DESTINATION`, `LIEUDESTINATION`, `DATELIVRAISON`) VALUES (?,?,?,?) ";
        return Manager::reqAction($req,...$parametres);

    }




    /**
     * @param mixed $identifient  Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req=" UPDATE `commandes` SET `CODECL`=?,`DESTINATION`=?,`LIEUDESTINATION`=?,`DATELIVRAISON`=? WHERE `NUMCOM`=? ";
        return Manager::req($req,...$parametres);
    }

    function actuEtat(...$parametres){
        $req=" UPDATE `commandes` SET etats=? WHERE `NUMCOM`=? ";
        return Manager::reqAction($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     */
    function afficherTout()
    {
        $req="SELECT * FROM `commandes` ORDER BY NUMCOM DESC ";
        return Manager::req($req);
    }

    function afficherToutSelonClient($idClient)
    {
        $req="SELECT `NUMCOM`, `CODECL`, `DESTINATION`, `LIEUDESTINATION`, `DATELIVRAISON`,etats FROM `commandes` WHERE CODECL=? ORDER BY NUMCOM DESC ";
        return Manager::req($req,$idClient);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient
     */
    function afficherUn(...$parametres)
    {
        $req=" SELECT `NUMCOM`, `CODECL`, `DESTINATION`, `LIEUDESTINATION`, `DATELIVRAISON` FROM `commandes` WHERE NUMCOM=? ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * @param $parametres   Identifient pour la suppression
     * @return mixed    Supprimer un element
     */
    function supprimer($parametres){
        $req="DELETE FROM commandes WHERE NUMCOM=? ";
        return Manager::reqOne($req,...$parametres);
    }


}
