<?php

class PanierC {
    function afficherPanier ($id_client)
    {
        $sql="SELECT * From images i,panier p,produit p1 where id_client=$id_client and p1.produit_id=id_produit and i.produit_id=id_produit and i.type='principal'";
        $db = config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function afficherPanierSession($id_produit)
    {
        $sql="SELECT * From images i,produit p1 where p1.produit_id=$id_produit and i.produit_id=p1.produit_id and i.type='principal'";
        $db = config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function calculPanier ($id_client)
    {
        $conn=Config::getConnexion();
        $sql="SELECT * from panier where id_client=$id_client";
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }
    function rechercherPanier($id_client,$id_produit)
    {
        $db=Config::getConnexion();
        $sql="SELECT * from panier where id_client=$id_client AND id_produit=$id_produit";
        $req=$db->prepare($sql);
        try
        {

            $req->execute();

            if ($req->rowCount()>0)
                return true;
            else
                return false;
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
        }
    }
    function ajouterProduit($panier){
        $id_client=$panier->getId_client();
        $id_produit=$panier->getId_produit();
        if (panierC::rechercherPanier($id_client,$id_produit)==true)
        {
            header('Location: afficherPanier.php');
        }
        else
        {
            $sql="INSERT into panier (id_client,id_produit,qte) values (:id_client, :id_produit,:qte)";
            $db = config::getConnexion();
            try{
                $req=$db->prepare($sql);

                $qte=$panier->getQte();
                $req->bindValue(':id_client',$id_client);
                $req->bindValue(':id_produit',$id_produit);
                $req->bindValue(':qte',$qte);

                if( $req->execute())
                {
                    return true;
                }

            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }
        }

    }
    function ajouterProduitReturn($id_client,$id_produit,$qte){
        if (panierC::rechercherPanier($id_client,$id_produit)==true)
        {
            header('Location: afficherPanier.php');
        }
        else
        {
            $sql="INSERT into panier (id_client,id_produit,qte) values (:id_client, :id_produit,:qte)";
            $db = config::getConnexion();
            try{
                $req=$db->prepare($sql);
                $req->bindValue(':id_client',$id_client);
                $req->bindValue(':id_produit',$id_produit);
                $req->bindValue(':qte',$qte);

                if( $req->execute())
                {
                    return true;
                }

            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }
        }

    }

    function supprimerProduitPanier($id_produit,$id_client){
        $sql="DELETE FROM panier where id_produit=:id_produit and id_client=:id_client";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id_client',$id_client);
        $req->bindValue(':id_produit',$id_produit);
        try{
            $req->execute();
            header('Location: afficherPanier.php');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function supprimerProduitPanierSession($id_produit)
    {
        $tmp=array();
        $tmp['id_produit'] = array();
        $tmp['qte'] = array();

        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            if ($_SESSION['panier']['id_produit'][$i] !== $id_produit)
            {
                array_push( $tmp['id_produit'],$_SESSION['panier']['id_produit'][$i]);
                array_push( $tmp['qte'],$_SESSION['panier']['qte'][$i]);
            }
        }
        $_SESSION['panier'] =  $tmp;
        unset($tmp);
        header('Location: afficherPanier.php');
    }
    function modifierPanierSession($id_produit,$qte)
    {
        if ($qte > 0)
        {
            $positionProduit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
            if ($positionProduit !== false)
            {
                $_SESSION['panier']['qte'][$positionProduit] = $qte ;
            }
        }
        else
            PanierC::supprimerProduitPanierSession($id_produit);
        header('Location: afficherPanier.php');
    }
    function modifierPanier($id_client,$id_produit,$qte){
        $sql="UPDATE panier SET qte=:qte WHERE id_produit=:id_produit and id_client=:id_client";

        $db = config::getConnexion();
        $req=$db->prepare($sql);
        //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        try
        {
            $req->bindValue(':id_client',$id_client);
            $req->bindValue(':id_produit',$id_produit);
            $req->bindValue(':qte',$qte);
            $s=$req->execute();
            header('Location: afficherPanier.php');
        }
        catch (Exception $e)
        {
            echo " Erreur ! ".$e->getMessage();
            echo " Les datas : " ;
            print_r($datas);
        }
    }
    function creationPanier()
    {
        if (!isset($_SESSION['panier']))
        {
            $_SESSION['panier']=array();
            $_SESSION['panier']['id_produit'] = array();
            $_SESSION['panier']['qte'] = array();
        }
        return true;
    }
    function ajouterProduitSession($id_produit,$qte)
    {
        $positionProduit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
        if ($positionProduit !== false)
        {
            $_SESSION['panier']['qte'][$positionProduit] += $qte ;
        }
        else
        {
            array_push( $_SESSION['panier']['id_produit'],$id_produit);
            array_push( $_SESSION['panier']['qte'],$qte);
        }
    }
    function transfertSessionPanier($id_client)
    {
        $nb=count($_SESSION['panier']['id_produit']);
        if ($nb>0)
        {
            $comm=new commandeC();
            $comm->supprimerPanier($id_client);
            for ($i=0;$i<$nb;$i++)
            {
                panierC::ajouterProduitReturn($_SESSION['id'],$_SESSION['panier']['id_produit'][$i],$_SESSION['panier']['qte'][$i]);
            }
            unset($_SESSION['panier']);
        }
    }

}