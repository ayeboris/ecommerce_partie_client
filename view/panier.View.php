<?php $titre = "Ecommerce | Le panier"; ?>
<?php ob_start(); ?>

<?php
//Appel de la fonction contenant toutes les methodes du panier
include_once('includes/fonctions-panier.php');

////Initialiser le panier
//creationPanier();
?>
    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <?php if (  !empty($_SESSION['panier']['libelleProduit']) ):

                    ?>

                <div class="col col-md-12" >

                    <form method="post" action="index.php?url=panier">
                        <h3>PANIER</h3>
                        <div class="table-responsive text-nowrap">
                            <!--Table-->
                            <table class="table table-striped">

                                <!--Table head-->
                                <thead>
                                <tr>

                                    <th>Articles</th>

                                    <th>quantite</th>
                                    <th>sous-total</th>
                                    <th colspan="2"></th>
                                </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>
                                <?php

                                //Ajouter les info necessaires au panier
                                //ajouterArticle($idProduit=$article['CODEART'],$qteProduit=@$_POST['quantite'],$prixProduit=$article['PRIX']);

                                //echo "POST";
//                                verification($_POST);
//                                echo "GET";
//                                verification($_GET);
//                                echo "SESSION";
//                                verification($_SESSION['panier']);
                                //Vider le panier

//                                unset($_SESSION['panier']);

                                for($i=0 ;$i< count($_SESSION['panier']['libelleProduit']);$i++){

                                    //Afficher tous les infos d'article a partir de l'idPoduit
                                    $article = (new ArticlesManager())->afficherUn($_SESSION['panier']['libelleProduit'][$i]);

                                    //                                    echo($article['CODEART']);
                                    //                                    echo($article['CODECATEGORIE']);
                                    //                                    echo($article['TITRE']);
                                    //                                    echo($article['DESCRIPTION']);
                                    //                                    echo($article['PRIX']);
                                    //                                    echo($article['QUANTITE']);
                                    //                                    echo($article['PHOTO']);
                                    //                                    echo($article['idmarque']);
                                    //                                    echo($article['date_publication']);


//                                    echo ($_SESSION['panier']["libelleProduit"][$i])."<br/>";
//                                    echo ($_SESSION['panier']["qteProduit"][$i])."<br/>";
//                                    echo ($_SESSION['panier']["prixProduit"][$i]."<br/>");

                               ?>
                                <tr>
                                    <th>
                                        <div>
                                            <h6><?= $article['TITRE'] ?></h6>
                                            <input type="hidden" name="idlibelle[]" value="<?= $_SESSION['panier']['libelleProduit'][$i] ?>" >

                                            <div class="row">
                                                <img width="100" src="public/img/<?= $article['PHOTO'] ?>" alt="photo">
                                                <span style="color: #ff0101b0;margin-left: 41px;" id="prixUnit"><?= $_SESSION['panier']['prixProduit'][$i] ?> Fcfa </span>
                                            </div>

                                        </div>

                                    </th>

                                    <td style="vertical-align:middle;">
                                        <input id="quantiteP" class="text-center" type="number" name="quantiteP[]" value="<?=  $_SESSION['panier']["qteProduit"][$i]  ?>">
                                    </td>

                                    <td style="vertical-align:middle;">
                                        <div id="prixproduit">
                                            <?= calculSousTotal($i) ?> Fcfa
                                        </div>

                                    </td>

                                    <td style="vertical-align:middle;"><a href="index.php?url=panier&action=supprimerArticle&idArticle=<?= $_SESSION['panier']["libelleProduit"][$i] ?>" class="btn btn-default">Supprimer</a> </td>
                                </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                <!--Table body-->

                            </table>
                            <!--Table-->
                        </div>

                    <!--Section: PANIER-->
                        <input type="hidden" name="action" value="ActualiserPanier">

                        <input class="btn-actu-panier btn-group-sm bg-success"  type="submit" value="Actualiser le panier">
                    </form>

                </div>

                <br>
                <div class="col-md-12 card " >
<!--                    VALIDER LE PANIER -->
                    <form method="post" action="index.php?url=valider" >
                        <div class="table-responsive text-nowrap">
                            <!--Table-->
                            <table class="table table-striped">

                                <!--Table head-->
                                <thead>
                                <tr>
                                    <th><h5>Total</h5></th>

                                    <th><?= MontantGlobal() ?> FCFA</th>
                                </tr>
                                <tr>
                                    <th><h5>Nombre articles</h5></th>
                                    <th><?=  nombreArticle(); ?></th>
                                </tr>
                                <tr>
                                    <th><h5>FRAIS DE LIVRAISON</h5></th>
                                    <th><i>TOUT FRAIS DE LIVRAISON N'EST PAS INCLUS</i></th>
                                </tr>

                                <tr>
                                    <th colspan="1"><button class="primary-btn" type="submit">Valider Achat</button></th>
                                    <th colspan="1"><a href="index.php" class="bg-btn btn-primary primary-btn">Continuer son shopping</a></th>

                                    <th colspan="1"><a href="index.php?url=index&action=viderPanier" class="bg-btn btn-warning primary-btn">vider le panier</a></th>
                                </tr>
                                </thead>
                                <!--Table head-->

                            </table>
                            <!--Table-->
                        </div>

                        <!--Section: PANIER-->
                        <input type="hidden" name="url" value="ValiderPanier">
                        <input type="hidden" name="action" value="validerPanier">
                    </form>
                </div>


                <?php else: ?>
                <h1>AUCUN ELEMENT DANS LE PANIER</h1>
                    <?php
                ////Teste
//                                echo "POST";
//                                verification($_POST);
//                                echo "GET";
//                                verification($_GET);
//                                echo "SESSION";
//                                verification($_SESSION['panier']);
//
//                                echo "Vider le panier";
                                //unset($_SESSION['panier']);
                    ?>
                <?php endif; ?>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- ================================================================================== -->


<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>