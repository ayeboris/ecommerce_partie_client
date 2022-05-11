<?php


// TODO : =================FONCTION NECESSAIRES ===========
/**
 * @param $input    Le input saisi dans le parametre
 * @return mixed    Retourne le input en format tel saisi
 */

function saisi_filtre($input){
    $data=trim($input);
    $data=stripslashes($data);
    $data=htmlentities($data);
    $data=nl2br($data);
    return $data;
}

function verification($parametre){
    //Juste controle
    echo "<pre>";
    print_r($parametre);
    echo "</pre>";
}

// TODO : ================= LES CLASSES INDISPENSABLES REFERENT LES PAGES POUR LE BON DEROULEMENT DU SITE ===========
//Declaration de sessions pour reconnaissance des Variables dans tous les sites Webs
session_start();

//Appel de la fonction contenant toutes les methodes du panier
include_once('view/includes/fonctions-panier.php');

require("controler/frontend.php");

// TODO : =================Information Generale de l'entreprise ===========
$_SESSION['Entreprise']['logo']="SHOP VOITURES";
$_SESSION['Entreprise']['tel']="+22500000000";
$_SESSION['Entreprise']['mail']="Shop_voiture@miage.ci";
$_SESSION['Entreprise']['lieu']="Abidjan";
$_SESSION['Entreprise']['Description']="Nous sommes un magasin de vente d'automobile.Nous offrons la possibilité a tout le monde de s'offrire une montre de rêve tres moins chere.Nous sommes en ce moment a Abidjan.";


try {
    //La liste des lien URL dans le prog
    $listeURL=array();

    // C'est le ROOTER: selectionne le bon controller selon le parametre URL
    if (isset($_GET['url'])) {
        //Lien de redirection
        $url=$_GET['url'];

        // TODO : =================AFFICHER LES PAGES=== SELON == URL ===========
        // page d'accueil
        if ($url == 'index') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);
            frontendPublic::index();
        }

        if ($url == 'connexion') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action
            frontendPublic::connexion();
        }

        if ($url == 'detail') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            frontendPublic::detail();
        }

        if ($url == 'inscription') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            @frontendPublic::inscription();
        }

        if ($url == 'paiement') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action
            frontendPublic::paiement();
        }

        if ($url == 'panier') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action
            frontendPublic::panier();

        }

        //PAGE DE RECHERCHE
        if ($url == 'rechercher') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            frontendPublic::recherche();
        }

        //PAGE LISTE DES ARTICLES DE COMMANDE
        if($url == 'listeArticleCommande'){
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            frontendPublic::listeArticleCommande();
        }

        if ($url == 'valider') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            frontendPublic::ValiderPanier();
        }



        //Profil de l'utilisateur et son historique panier
        if ($url == 'profile') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            frontendPublic::Profile();
        }

        //Retrouve identifient du compte par son email
        if ($url == 'retrouveIdentifient') {
            // Les operations a effectue selon l'action : name=action
            array_push($listeURL,$url);

            // Les operations a effectue selon l'action : name=action

            frontendPublic::retrouveIdentifient();
        }

        //-------------CONTROLE D'URL POUR AFFICHER LA PAGE D'ERREUR en cas ou un voleur tentera des betises---------------

        if(!in_array($url,$listeURL) ){
            include("view/includes/head_conf.html");
            include("view/includes/include_header.php");
            echo "<div class='container'><br><br><h3><b>La page que vous demandez n'a pas pu être trouvée.</b></h3><br><br></div>";
            echo "<div class='container'><img style='width:-webkit-fill-available;' src='public/img/the404.svg' alt='photo erreur'></div>";
            include("view/includes/include_footer.php");
            exit();
        }


    } else {

        $_GET['url']="index";
        header('location: index.php?url=index ');
        exit();
    }
} catch (Exception $errors) {
    $erreur=$errors->getMessage();
    require('view/error.View.php');

}
// TRAITEMENT DES REQUETES



