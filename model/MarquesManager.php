<?php


// use \model\PDO\Dbconnect;
class MarquesManager extends Manager
{

    /**
     * @param mixed ...$parametres Parametre sous forme : ( "CLE1=>VALEUR,CLE2=>VALEUR" )
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `marques`( `libelle`, `photo`) VALUES (?,?) ";
        return Manager::req($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req="UPDATE `marques` SET `libelle`=?,`photo`=? WHERE idmarque=? ";
        return Manager::req($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     */
    function afficherTout()
    {
        $req=" SELECT `idmarque`, `libelle`, `photo` FROM `marques`";
        return Manager::req($req);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient
     */
    function afficherUn(...$parametres)
    {
        $req="SELECT `idmarque`, `libelle`, `photo` FROM `marques` WHERE idmarque=? ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * supression
     */
    function supression(...$parametres)
    {
        $req="DELETE  FROM 'marques' WHERE idmarque=?";
         return Manager::reqOne($req,...$parametres);
        }


}
