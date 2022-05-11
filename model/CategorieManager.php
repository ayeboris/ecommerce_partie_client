<?php


// use \model\PDO\Dbconnect;
class CategorieManager extends Manager
{

    /**
     * @param mixed ...$parametres `LIBELLE`, `PHOTO`
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `categorie`( `LIBELLE`, `PHOTO`) VALUES (?,?) ";
        return Manager::req($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Libelle, Photo,CODECATEGORIE
     *              Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req=" UPDATE `categorie` SET `LIBELLE`=?,`PHOTO`=? WHERE `CODECATEGORIE`=? ";
        return Manager::req($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     * PARAMETRE : `CODECATEGORIE`, `LIBELLE`, `PHOTO`
     */
    function afficherTout()
    {
        $req=" SELECT `CODECATEGORIE`, `LIBELLE`, `PHOTO` FROM `categorie`  ";
        return Manager::req($req);
    }


    /**
     * @param mixed $parametres  Affiche l'info selon un identifient: CODECATEGORIE
     *          `CODECATEGORIE`, `LIBELLE`, `PHOTO`
     */
    function afficherUn(...$parametres)
    {
        $req=" SELECT `CODECATEGORIE`, `LIBELLE`, `PHOTO` FROM `categorie` WHERE CODECATEGORIE=?  ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * @param $parametres   Identifient pour la suppression
     * @return mixed    Supprimer un element
     */
    function supprimer($parametres){
        $req="DELETE FROM categorie WHERE CODECATEGORIE=? ";
        return Manager::reqOne($req,...$parametres);
    }

}
