<?php


// use \model\PDO\Dbconnect;
class Noter_commentairesManager extends Manager
{

    /**
     * @param mixed ...$parametres Parametre sous forme : `CODECL`, `CODEART`, `NOTE`, `COMMENTAIRE`
     * @return Ajouter|void Fonction retournant
     */
    function ajouter(...$parametres)
    {
        $req=" INSERT INTO `noter`(`CODECL`, `CODEART`, `NOTE`, `COMMENTAIRE`) VALUES (?,?,?,?)";
        return Manager::reqAction($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Mise a jour de l'info selon un identifient
     */
    function miseAjour(...$parametres)
    {
        $req="UPDATE `noter` SET `CODECL`=?,`CODEART`=?,`NOTE`=?,`COMMENTAIRE`=? WHERE CODEART=? ";
        return Manager::reqAction($req,...$parametres);
    }


    /**
     * Affiche toutes les infos dans la BD
     */
    function afficherTout()
    {
        $req="SELECT A.* ,B.TITRE ,C.EMAIL FROM noter A ,articles B ,clients C WHERE C.CODECL= A.CODECL AND B.CODEART=A.CODEART ";
        return Manager::req($req);
    }

    /**
     * @param mixed ...$parametres
     * @return mixed    Retourne la moyenne pour chaque article vote
     */
    function getMoyennenote(...$parametres){

        $req="SELECT (SUM(note)/count(note)) as Moyenne FROM noter  WHERE CODEART=? ";
        return Manager::reqOne($req,...$parametres);

    }


    /**
     * @param mixed $identifient  Affiche l'info selon un identifient
     */
    function afficherSelonArticleClient(...$parametres)
    {
        $req="SELECT A.* ,B.TITRE ,C.EMAIL FROM noter A ,articles B ,clients C WHERE C.CODECL= A.CODECL AND B.CODEART=A.CODEART AND A.CODECL=? AND A.CODEART=? ORDER BY A.DATE_VOTE DESC ";
        return Manager::reqOne($req,...$parametres);
    }

    function afficherSelonArticle(...$parametres)
    {
        $req="SELECT DISTINCT *  FROM noter WHERE CODEART=? ORDER BY DATE_VOTE DESC ";
        return Manager::req($req,...$parametres);
    }


    /**
     * Controle si la saisi est bien presente dans le texte
     * @param $texte  texte saisi
     * @param $mot  Mot a retrouver
     */
    function controleInjure($texte ,$mot){

        $listeMot=explode(',',$mot);
        foreach($listeMot as $mots){
            // Detecte un mot dans un texte
            if(strpos($texte, $mots) !== false){
                return 1;
            } else{
                return 0;
            }
        }

    }
    
}
