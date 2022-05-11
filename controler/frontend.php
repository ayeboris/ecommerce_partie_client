<?php
require("model/frontend.php");

// LE CONTROLEUR / CONTROLER: creer des fonctions implementant les views et les models a inclure


class frontendPublic{

    // Accès a la page d'accueil : index.View.php
    public static function index()
    {
        // -----------CONTROLEUR POUR LE POSTE ARTICLE ET SES COMMENTAIRES

        require("view/index.View.php");
    }


    public static function listeArticleCommande(){
        require("view/listeArticleCommande.View.php");
    }

    public static function retrouveIdentifient(){
        require("view/retrouveIdentifient.View.php");
    }

    public static function error()
    {
        $errors ="CETTE ADRESSE URL N'EXISTE PAS ,VOUS ETES UN PIRATE";
        require('view/error.View.php');
    }

    public static function connexion()
    {

        require('view/connexion.View.php');
    }

    public static function detail()
    {

        require('view/detail.View.php');
    }

    public static function inscription()
    {

        require('view/inscription.View.php');
    }

    public static function paiement()
    {
        require('view/paiement.View.php');
    }

    public static function panier()
    {

        require('view/panier.View.php');
    }

    public static function recherche()
    {

        require('view/recherche.View.php');
    }

    public static function ValiderPanier()
    {

        require('view/ValiderPanier.View.php');
    }

    public static function Profile()
    {

        require('view/Profile.View.php');
    }

}

