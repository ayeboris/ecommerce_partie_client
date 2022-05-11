<?php


// use \model\PDO\Dbconnect;
class ClientsManager extends Manager
{

    /**
     * @param mixed ...$parametres Parametre sous forme :`EMAIL`, `CONTACT`, `IDENTIFIENT`, `PASSE_CODE`, `DATE_NAISSANCE`, `DATE_ABONNE`
     * @return Ajouter|void Fonction AJOUT UNE LIGNE
     *
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)

        $req=" INSERT INTO `clients`( `EMAIL`, `CONTACT`, `NOM`, `PASSE_CODE`, `PRENOM`) VALUES (?,?,?,?,?) ";
        return Manager::reqAction($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Parametre sous forme :`EMAIL`, `CONTACT`, `IDENTIFIENT`, `PASSE_CODE`, `DATE_NAISSANCE`, `DATE_ABONNE`,CODECL
     */
    function miseAjour(...$parametres)
    {
        $req=" UPDATE `clients` SET `EMAIL`=?,`CONTACT`=?,`NOM`=?,`PRENOM`=? WHERE `CODECL`=? ";
        return Manager::reqAction($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     *  `CODECL`, `EMAIL`, `CONTACT`, `IDENTIFIENT`, `PASSE_CODE`, `DATE_NAISSANCE`, `DATE_ABONNE`
     */
    function afficherTout()
    {
        $req=" SELECT `CODECL`, `EMAIL`, `CONTACT`, `NOM`, `PASSE_CODE`, `PRENOM`, `DATE_ABONNE` FROM `clients` ORDER BY codecl DESC ";
        return Manager::req($req);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient : CODECL
     */
    function afficherUn(...$parametres)
    {
        $req=" SELECT `CODECL`, `EMAIL`, `CONTACT`, `NOM`, `PASSE_CODE`, `PRENOM`, `DATE_ABONNE` FROM `clients` WHERE CODECL=? ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * @param $parametres   Identifient pour la suppression
     * @return mixed    Supprimer un element
     */
    function supprimer(...$parametres){
        $req="DELETE FROM clients WHERE CODECL=? ";
        return Manager::reqAction($req,...$parametres);
    }

    function connexion(...$parametres){
        $req=" SELECT `CODECL`, `EMAIL`, `CONTACT`, `NOM`, `PASSE_CODE`, `PRENOM`, `DATE_ABONNE` FROM `clients` WHERE EMAIL=? AND PASSE_CODE=?";
        return Manager::reqOne($req,...$parametres);
    }

    function RecoverIdentifient(...$parametres){
        $req=" SELECT `EMAIL`, `PASSE_CODE` FROM `clients` WHERE EMAIL=? ";
        return Manager::reqOne($req,...$parametres);
    }

}
