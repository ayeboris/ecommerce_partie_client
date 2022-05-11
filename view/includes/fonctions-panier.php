<?php

    function creationPanier(){
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['sousTotalProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }

/**
 * @param $libelleProduit   Identifient de l'article
 * @param $qteProduit   Quantite de l'article
 * @param $prixProduit  Prix de l'article
 */
function ajouterArticle($libelleProduit,$qteProduit,$prixProduit){

        //Si le panier existe
        if (creationPanier())
        {
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);

            if ($positionProduit !== false)
            {
                calculSousTotal($positionProduit);
                //$_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
            }
            else
            {
                //Sinon on ajoute le produit
                array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
                array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
                array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
                array_push( $_SESSION['panier']['sousTotalProduit'],$prixProduit*$qteProduit);
            }
        }
        else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }


/**
 * @param $libelleProduit   Supprimer un article par son id
 */
    function supprimerArticle($libelleProduit){
        //Si le panier existe
        if (creationPanier() )
        {
            //Nous allons passer par un panier temporaire
            $tmp=array();
            $tmp['libelleProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['sousTotalProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
            {
                if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
                {
                    array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
                    array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                    array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
                    array_push( $tmp['sousTotalProduit'],$_SESSION['panier']['sousTotalProduit'][$i]);
                }

            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] =  $tmp;
            //On efface notre panier temporaire
            unset($tmp);
        }
        else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

/**
 * Fonction pour vider le panier
 */
    function viderPanier(){
        unset($_SESSION['panier']);
    }

/**
 * @param $libelleProduit   Modifier un article par son identifient
 * @param $qteProduit       Modifier un article par sa quantite
 */
    function modifierQTeArticle($libelleProduit,$qteProduit){
        //Si le panier existe
        if (creationPanier() )
        {
            //Si la quantité est positive on modifie sinon on supprime l'article
            if ($qteProduit > 0)
            {
                //Recherche du produit dans le panier
                $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);

                if ($positionProduit !== false)
                {
                    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
                    //calculSousTotal($positionProduit);
                }
            }
            else
                supprimerArticle($libelleProduit);
        }
        else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

/**
 * @return float|int    Donne le montant total calcule: Qte x prixArticle
 */
    function MontantGlobal(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
        {
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
            $_SESSION['panier']['sousTotalProduit'][$i]=$total;
        }
        return $total;
    }

/**
 * @param $i
 * @return float|int    Retourne le sous total d'un article/produit
 */
    function calculSousTotal($i){
        return $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
    }

    /*
     *  Donne le nombre total d'element dans le panier
     */
    function nombreArticle(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
        {
            $total += $_SESSION['panier']['qteProduit'][$i];
        }
        return $total;
    }


