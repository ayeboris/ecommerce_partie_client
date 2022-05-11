<?php


// use \model\PDO\Dbconnect;
class LigneComManager extends Manager
{

    /**
     * @param mixed ...$parametres Parametre sous forme : ( "CLE1=>VALEUR,CLE2=>VALEUR" )
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `lignecom`(`CODEART`, `NUMCOM`, `QUANTITE`, `SOUSTOTAL`) VALUES (?,?,?,?) ";
        return Manager::reqAction($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req="UPDATE `lignecom` SET `CODEART`=?,`NUMCOM`=?,`QUANTITE`=?,`SOUSTOTAL`=? WHERE `CODEART`=? AND `NUMCOM`=? ";
        return Manager::reqOne($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     */
    function afficherTout()
    {
        $req="SELECT * FROM `lignecom` ORDER BY NUMCOM ";
        return Manager::req($req);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon la commande
     */
    function afficherUn(...$parametres)
    {
        $req="SELECT `CODEART`, `NUMCOM`, `QUANTITE`, `SOUSTOTAL` FROM `lignecom` WHERE NUMCOM=? ";
        return Manager::reqOne($req,...$parametres);
    }





}
