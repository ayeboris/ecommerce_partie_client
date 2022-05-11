<?php

// use \model\PDO\Dbconnect;
class ArticlesManager extends Manager
{

    /**
     * @param mixed ...$parametres Parametre sous forme : ( "CLE1=>VALEUR,CLE2=>VALEUR" )
     * @return Ajouter|void Fonction retournant
     *      `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`, `PHOTO`, `idmarque`
     */
    function ajouter(...$parametres)
    {
//        TODO : Recuperer les parametres et leur valeur dans le champ : $parametres=('A'=>1,'B'=>2)
//
        $req=" INSERT INTO `articles`( `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`,`PHOTO_TITRE`, `PHOTO`,`PHOTO_BIN`, `idmarque`) VALUES (?,?,?,?,?,?,?,?,?) ";
//        $fichier =$_FILES["photo"]["name"] ;
//        $fichier_bin = $_FILES["photo"]["tmp_name"] ;

        //$fichier_lien='public/img/'.$fichier;
        //move_uploaded_file($fichier_bin,$fichier_lien);
        return Manager::req($req,...$parametres);

    }



    /**
     * @param mixed ...$parametres  Les Parametres :  `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`, `PHOTO`, `idmarque`,`CODEART`,
     * @return mixed    Retourne une ligne mise a jour
     */
    function miseAjour(...$parametres)
    {
        $req="UPDATE `articles` SET `CODECATEGORIE`=?,`TITRE`=?,`DESCRIPTION`=?,`PRIX`=?,`QUANTITE`=?,`PHOTO`=?,`idmarque`=? WHERE CODEART = ? ";
        return Manager::req($req,...$parametres);
    }

    function miseAjourQuantite(...$parametres)
    {
        $req="UPDATE articles, lignecom SET articles.QUANTITE= (articles.QUANTITE - lignecom.QUANTITE) where lignecom.CODEART=articles.CODEART ";
        return Manager::req($req,...$parametres);
    }

    /**
     * Affiche toutes les infos dans la BD
     */
    /**
     * @return mixed Affiche toutes les infos ligne BD
     * Les champs ressortis : `CODEART`, `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`, `PHOTO`, `idmarque`, `date_publication`
     */
    function afficherTout()
    {
        $req="SELECT `CODEART`, `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`, `PHOTO`, `idmarque`, `date_publication` FROM `articles` ORDER BY CODEART DESC ";
        return Manager::req($req);
    }

    function afficherRecommandation(...$parametres)
    {
        $req="SELECT `CODEART`, `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`, `PHOTO`, `idmarque`, `date_publication` FROM `articles` WHERE CODECATEGORIE=? ORDER BY CODEART DESC LIMIT 3 ";
        return Manager::req($req,...$parametres);
    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient
     */
    /**
     * @param mixed ...$parametres  Parametre dependant : CODEART
     * @return mixed Une ligne d'info
     */
    function afficherUn(...$parametres)
    {
        $req="SELECT `CODEART`, `CODECATEGORIE`, `TITRE`, `DESCRIPTION`, `PRIX`, `QUANTITE`, `PHOTO`, `idmarque`, `date_publication` FROM `articles` WHERE CODEART=? ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * @param mixed ...$parametres  ID_MARQUE , CODE_CATEGORIE
     * @return mixed
     */


    function rechercherselonAside(...$parametres){

        if(!empty($parametres[0]) && !empty($parametres[1]) ){
            $req="SELECT DISTINCT A.* FROM categorie C ,marques M , articles A WHERE A.idmarque=? AND A.CODECATEGORIE=? ";
        }
        if(empty($parametres[0]) && empty($parametres[1]) ){
            $req="SELECT DISTINCT * FROM articles  ";
        }

        return Manager::req($req,...$parametres);
    }

    /**
     * @param mixed ...$parametres
     * @return mixed    Sorti de la recherche selon l' ID de la Categorie
     */
    function rechercherselonAsideSelonCategorie(...$parametres){

            $req="SELECT DISTINCT A.* FROM categorie C ,marques M , articles A WHERE A.CODECATEGORIE=? AND A.CODECATEGORIE=C.CODECATEGORIE ";


        return Manager::req($req,...$parametres);
    }

    /**
     * @param mixed ...$parametres
     * @return mixed    Sorti de la recherche selon l' ID de la marque
     */
    function rechercherselonAsideSelonMarque(...$parametres){

            $req="SELECT DISTINCT A.* FROM categorie C ,marques M , articles A WHERE A.idmarque=? AND A.idmarque=M.idmarque ";


        return Manager::req($req,...$parametres);
    }

    function rechercherselonBarRecherche(...$parametres){
//        $req="SELECT DISTINCT A.* FROM categorie C ,marques M , articles A WHERE (C.CODECATEGORIE=A.CODECATEGORIE OR A.idmarque=M.idmarque) AND (A.PRIX BETWEEN ? AND ?) AND (A.idmarque=? OR A.CODECATEGORIE=?) ";
        $req="SELECT * FROM articles WHERE TITRE LIKE ? ";
        return Manager::req($req,...$parametres);
    }

    /**
     * @param $parametres   Identifient pour la suppression
     * @return mixed    Supprimer un element
     */
    function supprimer(...$parametres){
        $req="DELETE FROM articles WHERE CODEART=? ";
        return Manager::reqOne($req,...$parametres);
    }

    /**
     * @param mixed ...$parametres  CodeClient et CodeCommande
     * @return mixed    Retourne la liste des articles pour un client et sa commande
     */
    function listeArticleParCommande(...$parametres){
        $req="SELECT articles.* ,lignecom.* from articles ,lignecom,commandes WHERE 
articles.CODEART=lignecom.CODEART AND 
lignecom.NUMCOM = commandes.NUMCOM AND 
commandes.CODECL=? AND commandes.NUMCOM=?";
        return Manager::req($req,...$parametres);
    }

    /**
     * @param mixed ...$parametres   CodeClient et CodeArticle
     * @return mixed    Les infos de l'article pour le client et l'article commande en question
     */
    function TestSiArticleCommenterParClientCorrespondArticelExiste(...$parametres){
        $req="SELECT distinct articles.* from articles ,lignecom,commandes WHERE 
articles.CODEART=lignecom.CODEART AND 
lignecom.NUMCOM = commandes.NUMCOM AND 
commandes.CODECL=? AND lignecom.CODEART=?";
        return Manager::req($req,...$parametres);
    }

    /**
     * @param mixed ...$parametres
     * @return mixed    Supprime les articles et la commande en question
     */
    function SupprimerArticleCommandeParClientCorrespondCommandeExistante(...$parametres){
        //Supprimer les articles commande(ligneDeCommandes)
        $req="DELETE lignecom FROM articles,lignecom,commandes WHERE 
lignecom.NUMCOM = commandes.NUMCOM AND 
commandes.CODECL=? AND commandes.numcom=?";

        //Supprimer la commande en question
        $req2="DELETE FROM commandes WHERE 
CODECL=? AND numcom=?";

        if(Manager::reqAction($req,...$parametres)){
            return Manager::reqAction($req2,...$parametres);
        }
        return false;

    }


    /**
     * @param mixed ...$parametres   CodeClient et NumCom
     * @return mixed    Somme de la commande en question de la refClient et NumCommande
     */
    function SommeArticlesCommandeParClientEtNumComm(...$parametres){
        $req="SELECT SUM(lignecom.SOUSTOTAL) from articles ,lignecom,commandes WHERE 
articles.CODEART=lignecom.CODEART AND 
lignecom.NUMCOM = commandes.NUMCOM AND 
commandes.CODECL=? AND commandes.NUMCOM=?";
        return Manager::reqOne($req,...$parametres);
    }

}
