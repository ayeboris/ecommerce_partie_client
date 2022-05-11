<?php
// TODO : ================= LES OPERATIONS A EFFECTUER SELON LES POST / GET DE * ACTION * DANS LE FORMULAIRE DE CHAQUE PAGES ===========

if(!isset($_SESSION)){

    session_start();

    //Recuperer les info du client
    $_SESSION['client']=array();

    //Recuperer les messages
    $_SESSION['msg']=array(
            'erreur'=>"",
            'succes'=>""
    );

    //Inclure le module qui comprend toutes les methodes du panier
    include_once('fonctions-panier.php');

    //Init le panier
    //creationPanier();

}
function loginON(){
    if (isset($_SESSION['client']) && isset($_SESSION['client']['id']) && isset($_SESSION['client']['identifient']) && isset($_SESSION['client']['password']) ){
        return true;
    }
    else{return false;}
}


// TODO OPERATION SI LA METHODE EST : POST      ==========================================
if(isset($_POST)){
    if(isset($_POST["action"])){

        //Operation de connexion
        if ($_POST['action']==='connexion'){

            $user = $_POST['email'];

            $mot_mot= $_POST['motpasse'];


            $client=(new ClientsManager())->connexion($user,$mot_mot);


            if($client != null){

                $_SESSION['client']=array(
                    'id'=>$client['CODECL'],
                    'identifient'=>$client['PRENOM'],
                    'password'=>$client['PASSE_CODE'],
                    'email'=>$client['EMAIL']
                );

                // INFO RECUPERE DANS SESSION
                $_SESSION['msg']['succes']="BIENVENU  {$_SESSION['client']['email']} ";

                header('Location:index.php?url=index');
//                exit;
            }
            else{

                $_SESSION['msg']['erreur']="Vous n'etes pas dans nos donnees ";
                header('Location:index.php?url=connexion');
                exit;
            }
        }

        //Operation d'inscription d'un client
        if ($_POST['action']==='inscription'){

            $email =$_POST['email'];
            $contact =$_POST['contact'];
            $nom =$_POST['nom'];
            $passe_code =$_POST['passe_code'];
            $prenom =$_POST['prenom'];

            $client=(new ClientsManager())->ajouter($email, $contact,$nom,$passe_code,$prenom);


            if(count($client) != null){

                // INFO RECUPERE DANS SESSION
                $_SESSION['msg']['succes']="Vous etes bien inscrit  ";

                @header('Location:index.php?url=inscription');
                exit;
            }
            else{

                $_SESSION['msg']['erreur']="Vous n'etes pas dans nos donnees ";
                header('Location:index.php?url=inscription');
                exit;
            }
        }

        //Operation pour donner les avis et attribuer des notes
        if($_POST['action']==='publier'){
            var_dump($_POST);
            //Controler si le mot apartient aux mots interdits :
            $injures= (new InjuresManager())->afficherTout();
            $ok=-1;
            foreach($injures as $injure){
                if((new Noter_commentairesManager())->controleInjure(nl2br(htmlspecialchars($_POST['commentaire'])),$injure['LIBELLE']) ===1){
                    $ok=1;
                    break;
                }else{
                    $ok=0;
                }
            }

            switch($ok){
                case 1:{
                    $_SESSION['msg']['erreur']="Vous avez saisi un mot desagreable ";
                    @header('Location:index.php?url=detail&idArticle='.$_POST[idArticle]);
                    break;
                }
                case 0:{

                    $commenter=(new Noter_commentairesManager())->ajouter($_POST['idClient'],$_POST['idArticle'], $_POST['note'],nl2br(htmlspecialchars($_POST['commentaire'])));


                    if($commenter != null){

                        // INFO RECUPERE DANS SESSION
                        $_SESSION['msg']['succes']="Votre message est bien parti  ";

                        @header('Location:index.php?url=detail&idArticle='.$_POST['idArticle']);
                        exit;
                    }
                    else{

                        $_SESSION['msg']['erreur']="Votre commentaire n est pas passe, joindre votre administrateur WEB ";
                        @header('Location:index.php?url=detail='.$_POST[idArticle]);
                        exit;
                    }


                }
            }

        }


        //Operation Pour le panier
        if($_POST['action']==='ajouterPanier'){
//            //Initialiser le panier
//            //creationPanier();
//            echo "POST";
//            verification($_POST);
//            echo "GET";
//            verification($_GET);
//            echo "SESSION";
//            verification($_SESSION['panier']);

            ajouterArticle($_POST['idProduit'],$_POST['quantite'],$_POST['prixProduit']);
            header("location:index.php?url=panier");


        }


        // Operation actualiser PANIER
        if($_POST['action'] == 'ActualiserPanier'){

            //Initialiser le panier
            //creationPanier();
//            echo "POST";
//            verification($_POST);
//            echo "GET";
//            verification($_GET);
//            echo "SESSION";
//            verification($_SESSION['panier']);

            //Modifier la quantite de l'article
            for($i=0;$i<count($_POST['idlibelle']);$i++){

                modifierQTeArticle($_POST['idlibelle'][$i],$_POST['quantiteP'][$i]);
            }

            header("Location:index.php?url=panier");

        }

        //OPERATION POUR VALIDER LA COMMANDE
        if($_POST['action'] == 'validerCommande'){
            echo "POST";
            verification($_POST);
            echo "GET";
            verification($_GET);
            echo "SESSION";
            verification($_SESSION['panier']);
            

            //Ajouter les infos de la commande et recuper le dernier ID cree dans cette table

           if((new CommandesManager())->ajouter($_POST['idClient'],$_POST['destination'],$_POST['lieudestination'],$_POST['datecommande']) == true){

               $idCommandeInterne= Manager::LastId('commandes','numcom');

           }
//           echo "Identifient du precedent insert";
//           verification($idCommandeInterne);


            //Enregistrer les infos dans la table ligne de commande suivant la taille d'elements dans le panier
            for($i=0;$i< count($_SESSION['panier']['libelleProduit']);$i++){
                (new LigneComManager())->ajouter($_SESSION['panier']['libelleProduit'][$i],$idCommandeInterne,$_SESSION['panier']['qteProduit'][$i],$_SESSION['panier']['sousTotalProduit'][$i]);
                //METTRE A JOUR CHAQUE QUANTITE D'ARTICLE DANS DEJA ENREGISTRES DANS LES LIGNES DE COMMANDES
                (new ArticlesManager())->miseAjourQuantite($_SESSION['panier']['libelleProduit'][$i]);
            }

            //Quand la commande est OK ==> Vider le panier
            viderPanier();

            //Indiquer un message de succes au client
            $_SESSION['msg']['succes']='VOTRE COMMANDE EST PRISE EN COMPTE, VISITER VOTRE HISTORIQUE POUR VOIR TOUTES VOS COMMANDES';
            header("Location:index.php?url=index");

        }

        //======= OPERATION POUR MODIFIER LE COMPTE
        if($_POST["action"] =='modifierCompteAction'){
            echo "POST";
            verification($_POST);
            echo "GET";
            verification($_GET);
            echo "SESSION";
            verification($_SESSION['panier']);

            $result=(new ClientsManager())->miseAjour($_POST['email'], $_POST['contact'],$_POST['nom'],$_POST['prenom'],$_POST['IdClient']);
            if($result==true){
                header('location:index.php?url=profile ');
            }

        }

        //======= OPERATION POUR Recuperer le mot de passe du COMPTE  ( PAS TESTE )
        if($_POST["action"] =='retrouveIdentifient'){

            $result=(new ClientsManager())->RecoverIdentifient($_POST['email']);
            if($result==true){

                $_SESSION['msg']['succes']['mail']=$result['EMAIL'];
                $_SESSION['msg']['succes']['motpasse']=$result['PASSE_CODE'];
                header('location:index.php?url=retrouveIdentifient ');
            }

        }

    }

}

// TODO OPERATION SI LA METHODE EST : GET       ======================
if(isset($_GET)){
    if(isset($_GET["action"])){

        //Action de deconnexion du compte
        if($_GET["action"]==='deconnecter'){
//            $_SESSION=array();
            unset($_SESSION['client']);
            $_SESSION['client']=array();
            header('location: index.php?url=index');
            exit;
        }


        //Operation suprimer un article dans le panier
        if ($_GET["action"] === "supprimerArticle"){
//            verification($_GET);
            supprimerArticle($_GET['idArticle']);
            header("location:index.php?url=panier");

        }

        //Action Pour vider le panier
        if($_GET["action"] ==='viderPanier'){
            viderPanier();
            header('location: index.php?url=panier');
            exit;
        }

        //======= OPERATION POUR SUPPRIMER LE COMPTE  ( PAS TESTE )
        if($_GET["action"] =='supprimerCompteAction'){

//            verification($_GET);
            $result=(new ClientsManager())->supprimer($_GET['idClient']);

            if($result==true){
                unset($_SESSION['client']);
                $_SESSION['client']=array();

                header('location:index.php?url=index ');
            }

        }



        //Action pour actualiser l'etat d une commande
        if($_GET["action"]==='actuEtats'){

            $result=-1;
            if($_GET["actuEtat"]==1){
                $result=0;
            }elseif($_GET["actuEtat"]==0){
                $result=1;
            }
            if((new CommandesManager())->actuEtat($result,$_GET["NumCom"])){
                header('location:index.php?url=profile');
                exit;
            }



        }

        //Action pour actualiser l'etat d une commande
        if($_GET["action"]==='supprimerCommande'){


            if((new ArticlesManager())->SupprimerArticleCommandeParClientCorrespondCommandeExistante($_SESSION['client']['id'],$_GET["NumCom"])){
                header('location:index.php?url=profile');
                exit;
            }
        }


    }
}



?>


<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="tel:<?= $_SESSION['Entreprise']['tel'] ?>"><i class="fa fa-phone"></i> <?= $_SESSION['Entreprise']['tel'] ?></a></li>
                <li><a href="mailto:<?= $_SESSION['Entreprise']['mail'] ?>"><i class="fa fa-envelope-o"></i> <?= $_SESSION['Entreprise']['mail'] ?></a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> <?= $_SESSION['Entreprise']['lieu'] ?></a></li>
            </ul>

            <ul class="header-links pull-right">
                <?php if(!loginON()) : ?>
                    <li><a href="index.php?url=connexion"><i class="fa fa-user-o"></i> Connexion</a></li>
                    <li><a href="index.php?url=inscription"><i class="fa fa-user-o"></i> Inscription</a></li>
                <?php else: ?>
                    <li><a href="index.php?url=index&action=deconnecter"><i class="fa fa-user-o"></i> Deconnexion</a> | <a href="index.php?url=profile&idClient=<?= $_SESSION['client']['id'] ?>"><i class="fa fa-user-md"></i> Profile de <?= $_SESSION['client']['identifient'] ?></a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="index.php" class="logo">
                            <h3 class="logo-titre"><?= $_SESSION['Entreprise']['logo'] ?></h3>
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div>
                        <form method="post" action="index.php?url=rechercher" class="header-search">

                            <input class="input" type="search" name="recherche" placeholder="rechercher ..." id="tabRecherche">
                            <!--     La PAGE OU SERA SERA EFFECTUE LE TRAITEMENT DE RECHERCHE                       -->
<!--                            <input type="hidden" name="url" value="rechercher">-->
                            <input type="hidden" name="valider">
                            <input type="hidden" name="barRechercher" >
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">

<!--                        <a href="index.php?url=produits">-->
<!--                            <span style="color:red;">LES VOITURES</span>-->
<!--                        </a>-->

                        <!-- Cart -->
                        <div class="dropdown">

                            <a href="index.php?url=panier">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Votre panier</span>
                                <?php if(!empty($_SESSION['panier']['qteProduit'])): ?>
                                <span class="qty"><?=  nombreArticle(); ?></span>
                                <?php else: ?>
                                <span class="qty"><?= '0' ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <!-- /Cart -->

                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->

            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
