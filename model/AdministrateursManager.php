<?php

class AdministrateursManager extends Manager
{
    /**
     * @param mixed ...$parametres Parametre sous forme : ( "CLE1=>VALEUR,CLE2=>VALEUR" )
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `administrateurs`( `EMAIL`, `CONTACT`, `IDENTIFIENT`, `PASSE_CODE`) VALUES (?,?,?,?) ";
        return Manager::req($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req="UPDATE `administrateurs` SET `EMAIL`=?,`CONTACT`=?,`IDENTIFIENT`=?,`PASSE_CODE`=? WHERE REFADMIN=? ";
        return Manager::req($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     */
    function afficherTout()
    {
        $req="SELECT `REFADMIN`, `EMAIL`, `CONTACT`, `IDENTIFIENT`, `PASSE_CODE`, `DATE_ABONNE` FROM administrateurs ORDER BY date_abonne DESC ";
        return Manager::req($req);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient
     */
    function afficherUn(...$parametres)
    {
        $req="SELECT `REFADMIN`, `EMAIL`, `CONTACT`, `IDENTIFIENT`, `PASSE_CODE`, `DATE_ABONNE` FROM administrateurs WHERE REFADMIN=? AND 1=1 ORDER BY date_abonne DESC ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * @param $parametres   Identifient pour la suppression
     * @return mixed    Supprimer un element
     */
    function supprimer($parametres){
        $req="DELETE FROM administrateurs WHERE REFADMIN=? ";
        return Manager::reqOne($req,...$parametres);
    }

}