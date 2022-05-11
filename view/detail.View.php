<?php $titre = "Ecommerce | Detail Produit"; ?>
<?php ob_start(); ?>

<?php
if (isset($_GET['idArticle'])){

    //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
    $article = (new ArticlesManager())->afficherUn($_GET['idArticle']);


//                                    echo($article['CODEART']);
//                                    echo($article['CODECATEGORIE']);
//                                    echo($article['TITRE']);
//                                    echo($article['DESCRIPTION']);
//                                    echo($article['PRIX']);
//                                    echo($article['QUANTITE']);
//                                    echo($article['PHOTO']);
//                                    echo($article['idmarque']);
//                                    echo($article['date_publication']);

?>

    <!-- ================================================================================== -->


    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="index.php?url=index">Accueil</a></li>
<!--                        <li><a href="index.php?url=categorie">Categorie</a></li>-->
                        <li class="active"><?= $article['TITRE'] ?>></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="public/img/<?= $article['PHOTO'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">

                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details Pour l'envoi dans la BD -->
                <div class="col-md-5">
                    <div class="product-details">
                        <!-- Product Titre -->
                        <h2 class="product-name"><?= $article['TITRE'] ?></h2>
                        <!-- Product Prix -->
                        <div>
                            <h3 class="product-price"><?= $article['PRIX'] ?></h3>
                            <!-- Product STOCK -->

                            <?php if($article['QUANTITE'] >0): ?>
                                <span class="product-available">DISPONIBLE</span>
                            <?php else: ?>
                                <span class="product-available">EN RUPTURE</span>
                            <?php endif; ?>

                        </div>
                        <!-- Product detaillé -->
                        <p><?= $article['DESCRIPTION'] ?></p>

                        <form action="index.php?url=panier" method="post" enctype="multipart/form" class="add-to-cart">

                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <?php if($article['QUANTITE']>0): ?>
                                    <input type="number" name="quantite" min="0" max="<?= $article['QUANTITE'] ?>" value="1">
                                    <?php else: ?>
                                    Impossible
                                    <?php endif; ?>
                                    <br>
                                </div>
                            </div>
                            <!-- Envoyer au panier l article -->
<!--                            ===============================================================-->
                            <input type="hidden" name="prixProduit" value="<?= $article['PRIX'] ?>">
                            <input type="hidden" name="idProduit" value="<?= $article['CODEART'] ?>">
                            <input type="hidden" name="action" value="ajouterPanier" />
<!--                            =============================================-->
                            <?php if($article['QUANTITE']>0): ?>
                            <input type="submit"  class="add-to-cart-btn" value="Ajouter au panier" />
                            <?php else: ?>
                            EN RUPTURE
                            <?php endif; ?>
                        </form>

                        <ul class="product-links">
                            <li>Marque:</li>
                            <?= $article['idmarque']  ?>
                            <li><a href="#"><?= (new MarquesManager())->afficherUn($article['idmarque'])['libelle']  ?></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Product details -->


            </div>
            <!-- /row -->

<!--            Statistiques des votes pour ce produit-->

            <div class="col-sm-12">
                <div class="rating-block">
                    <h4>Statique des Votes des participants</h4>
                    <!--  Moyenne des notes etoiles                              -->
                    <?php $MoyenneNotes=(new Noter_commentairesManager())->getMoyennenote($article['CODEART']); ?>

                    <h2 class="bold padding-bottom-7">
                        <?php if(isset($MoyenneNotes)){
                            echo number_format($MoyenneNotes['Moyenne'],2) ;}
                        else{
                            echo ("O");} ?> <small> / 5</small></h2>
                    <div class="product-rating">

                            <?php
                            if (!empty($MoyenneNotes['Moyenne'])){
                                for ($i=1;$i<= $MoyenneNotes['Moyenne'] ;$i++){
                                    ?>
                                    <i class="fa fa-star"></i>
                                <?php } ?>
                                <?php for ($i=0;$i<5-$MoyenneNotes['Moyenne'] ;$i++){
                                    ?>
                                    <i class="fa fa-star-o"></i>
                                <?php }
                            }else{
                                for ($i=1;$i<=5 ;$i++):
                            ?>
                                    <i class="fa fa-star-o"></i>
                        <?php endfor; } ?>

                    </div>
                </div>
            </div>
            <!--        Fin    Statistiques des votes-->

        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION  DONNER AVIS SUR UN PRODUIT-->
    <section>

        <div class="container">
            <h2>Produits de meme categorie</h2>
            <div class="row">
                <!-- product -->

                <?php
                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                $listeArticles=(new ArticlesManager())->afficherRecommandation($article['CODECATEGORIE']);


                foreach($listeArticles as $article){
                    //                                echo($article['CODEART']);
                    //                                echo($article['CODECATEGORIE']);
                    //                                echo($article['TITRE']);
                    //                                echo($article['DESCRIPTION']);
                    //                                echo($article['PRIX']);
                    //                                echo($article['QUANTITE']);
                    //                                echo($article['PHOTO']);
                    //                                echo($article['idmarque']);
                    //                                echo($article['date_publication']);

                    ?>
                    <div class="col-md-4 col-xs-6">

                        <!-- DEBUT product -->
                        <div class="product">
                            <form action="index.php?url=panier" method="post" enctype="multipart/form">


<!--                                /<input type="hidden" name="url" value="panier">-->

                                <div class="product-img">
                                    <img src="public/img/<?= $article['PHOTO'] ?>" alt="Photo de l'article">
                                    <div class="product-label">
                                        <?php if($article['QUANTITE'] >0): ?>
                                            <span class="new">DISPONIBLE</span>
                                        <?php else: ?>
                                            <span class="new">EN RUPTURE</span>
                                        <?php endif; ?>

                                    </div>
                                </div>

                                <div class="product-body">
                                    <p class="product-category"><a href="#"><?= (new CategorieManager())->afficherUn($article['CODECATEGORIE'])['LIBELLE']  ?></a></p>
                                    <h3 class="product-name"><a href="index.php?url=detail&idArticle=<?= $article['CODEART'] ?> "> <?= $article['TITRE'] ?> </a></h3>
                                    <h4 class="product-price"><?= $article['PRIX'] ?> FRCFA </h4>

                                    <!--   Affiche des etoiles pour chaque produit                                   -->
                                    <div class="product-rating">
                                        <?php
                                        //Moyenne des notes
                                        $MoyenneNotes=(new Noter_commentairesManager())->getMoyennenote($article['CODEART']);


                                        if (!empty($MoyenneNotes['Moyenne'])){
                                            for ($i=1;$i<= $MoyenneNotes['Moyenne'] ;$i++){
                                                ?>
                                                <i class="fa fa-star"></i>
                                            <?php } ?>
                                            <?php for ($i=0;$i< 5-$MoyenneNotes['Moyenne'] ;$i++){
                                                ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php }
                                        }else{
                                            for ($i=1;$i<=5 ;$i++):
                                                ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php endfor; } ?>
                                    </div>
                                    <!--   Fin=========== INOF POUR LA TRANSMISSION AU PANIER ===                                     -->
                                    <input type="hidden" name="quantite" value="1">
                                    <input type="hidden" name="prixProduit" value="<?= $article['PRIX'] ?>">
                                    <input type="hidden" name="idProduit" value="<?= $article['CODEART'] ?>">
                                    <input type="hidden" name="action" value="ajouterPanier" />


                                </div>
                                <?php if($article['QUANTITE'] >0): ?>
                                <button type="submit" class="btn btn-primary add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> Ajouter au panier </button>
                                <?php else: ?>
                                    <button type="submit" disabled class="btn btn-primary add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> Ajouter au panier </button>
                                <?php endif; ?>
                            </form>

                        </div>
                        <!-- FIN product -->

                    </div>
                    <!-- /product -->


                    <?php

                }
                ?>

            </div>
        </div>
    </section>

    <!-- SECTION  DONNER AVIS SUR UN PRODUIT-->
    <section>



    <br>
    <br>
        <div class="container">
            <?php
            if(!empty($_SESSION['msg']['succes'])){
                echo "<p class='alert btn-danger' id='alertbox' onclick=boxAlert()>";
                echo "<strong>".$_SESSION['msg']['succes']."</strong>";
                echo "</p>";
                unset($_SESSION['msg']['succes']);

            }
            if(!empty($_SESSION['msg']['erreur'])){
                echo "<p class='alert btn-danger' id='alertbox' onclick=boxAlert()>";
                echo "<strong>".$_SESSION['msg']['erreur']."</strong>";
                echo "</p>";
                unset($_SESSION['msg']['erreur']);

            }

            ?>
            <div class="row">
<!--                FORMULAIRE DE SAISI AVI ET COMMENTAIRES-->
                <form action="" method="post"  class=" col col-md-12 rate_block">
                    <input type="hidden" name="action" value="publier">

                    <div id="container section-vote">
                        <h2>Rediger un avis pour ce produit</h2>
                        <?php
                        if(isset($_SESSION['client']['id'])){
                            ?>

                            <?php if((new ArticlesManager())->TestSiArticleCommenterParClientCorrespondArticelExiste($_SESSION['client']['id'],$_GET['idArticle']) !=null): ?>
                        <div class="form-group">
                            <h4>Votre avis</h4>
                            <div class="section-etoiles">

                                <input type="radio" name="note" id="note1" class="notes" value="5">
                                <label for="note1" class=""></label>

                                <input type="radio" name="note" id="note2" class="notes" value="4">
                                <label for="note2"></label>

                                <input type="radio" name="note" id="note3" class="notes" value="3">
                                <label for="note3"></label>

                                <input type="radio" name="note" id="note4" class="notes" value="2">
                                <label for="note4"></label>

                                <input type="radio" name="note" id="note5" class="notes" value="1">
                                <label for="note5"></label>

                            </div>

                        </div>
                        <div class="form-controle">
                            <h4>Votre commentaire</h4>
                            <textarea name="commentaire" class="input" style="padding: 10px 15px;resize:none; height:100px;" required></textarea>
                        </div>

                            <input type="hidden" name="idClient" value="<?= $_SESSION['client']['id'] ?>">
                            <input type="hidden" name="idArticle" value="<?= $_GET['idArticle'] ?>">

                        <input type="submit" name="publier" value="Publier" class="btn btn-danger">
                            <?php else: ?>
                                <p class="alert alert-danger"> Vous devez avoir commande cet article avant de le commenter</p>
                            <?php endif; ?>
                        <?php
                            }else{
                            ?>
                        <p class="alert alert-danger"> Connectez-vous svp pour donner votre avi</p>
                        <?php
                        }
                        ?>
                    </div>

                </form>
<!--                Fin formulaire -->
            </div>
        </div>
        <?php
            }
        ?>

<!--        Liste des commentaires -->

        <div class="container">
            <div class="row">
                <?php
                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                $listecCommentaire=(new Noter_commentairesManager())->afficherSelonArticle($_GET['idArticle']);
                ?>

                <div class="col-md-12 liste-comments mt-4">

                    <div class="">
                        <br/><br>
                        <hr/>
                        <h3 >AVIS (<?= count($listecCommentaire) ?>)</h3>

                        <br/>
                        <div class="review-block">
                            <?php

                        foreach($listecCommentaire as $Commentaire){
                        //                                var_dump($Commentaire);

                        //                                                                echo($Commentaire['CODECL']);
                        //                                                                echo($Commentaire['CODEART']);
                        //                                                                echo($Commentaire['NOTE']);
                        //                                                                echo($Commentaire['COMMENTAIRE']);
                        //                                                                echo($Commentaire['DATE_VOTE']);

                            ?>
                            <!--                            Un commentaire publie avec champs de commentire non vide-->
                            <div class="row">

                            <!--      LIGNE DU COMMENTAIRE                          -->
                                <div class="col-sm-3">
                                    <?php $infoClient=(new ClientsManager())->afficherUn($Commentaire['CODECL'])['EMAIL']; ?>
                                    <div class="review-block-name"><b><?= $infoClient ?></b> </div>
                                    <?php  ?>
                                    <div class="review-block-date"><?= $Commentaire['DATE_VOTE'] ?><br/></div>
                                </div>
                                <div class="col-sm-9 ">
                                    <div class="review-block-rate">
                                    <!--                  LES NOTES ETOILE   DU CLIENT                   -->
                                        <div class="product-rating">
                                            <?php for ($i=1;$i<=$Commentaire['NOTE'] ;$i++){
                                                ?>
                                            <i class="fa fa-star"></i>
                                                    <?php } ?>
                                            <?php for ($i=1;$i<=5-$Commentaire['NOTE'] ;$i++){
                                                    ?>
                                                    <i class="fa fa-star-o"></i>
                                                <?php } ?>

                                        </div>
                                        <!--               Fin   LES NOTES ETOILE   DU CLIENT                   -->

                                    </div>
                                    <div class="review-block-description">
                                        <?= nl2br(htmlspecialchars($Commentaire['COMMENTAIRE'])) ?>
                                    </div>
                                </div>

                            </div>
                            <br><br>
                            <!--      FIN DU COMMENTAIRE                          -->
                            <?php
                                    }
                                ?>
                            <hr/>
                        </div>
                    </div>

                </div> <!-- /container -->

            </div>
        </div>

    </section>
    <!-- /SECTION -->


    <!-- ================================================================================== -->

<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>