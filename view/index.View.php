<?php $titre = "Ecommerce | Site de vente"; ?>
<?php ob_start(); ?>

    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <form action="index.php?url=rechercher" method="post">

                        <input type="hidden" name="asideRechercher" >



                        <!-- Categorie -->
                        <div class="aside">
                            <h3 class="aside-title">CATEGORIE DE VEHICULE</h3>

                            <select class="input-select" name="idcategorie">
                                <option value="0">Toutes les categories</option>
                                <!-- Debut Liste -->

                                <?php
                                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                                $listeCategorie= (new CategorieManager())->afficherTout();


                                foreach($listeCategorie as $article) {
                                    //                                    echo($article['CODECATEGORIE']);
                                    //                                    echo($article['LIBELLE']);
                                    //                                    echo($article['PHOTO']);


                                    ?>
                                    <option value="<?= $article['CODECATEGORIE'] ?>"><?= $article['LIBELLE'] ?></option>
                                    <!--  Fin liste                          -->
                                    <?php
                                }
                                ?>



                            </select>
                        </div>

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">MARQUES</h3>

                            <select class="input-select" name="idmarque">
                                <option value="0">Toutes les marques</option>
                                <!-- Debut Liste -->
                                <?php
                                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                                $listeMarques= (new MarquesManager())->afficherTout();


                                foreach($listeMarques as $marque) {
                                    //                                    echo($marque['idmarque']);
                                    //                                    echo($marque['libelle']);


                                    ?>
                                    <option value="<?= $marque['idmarque'] ?>"><?= $marque['libelle'] ?></option>
                                    <!--  Fin liste                          -->
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!-- /aside Widget -->


                        <!-- aside Widget -->
<!--                        <div class="aside">-->
<!--                            <h3 class="aside-title">PRIX</h3>-->
<!--                            <div class="price-filter">-->
<!--                                <div id="price-slider"></div>-->
<!--                                <div class="input-number price-min">-->
<!--                                    <input id="price-min" name="price-min" type="number"  value="1">-->
<!--                                    <span class="qty-up">+</span>-->
<!--                                    <span class="qty-down">-</span>-->
<!--                                </div>-->
<!--                                <span>-</span>-->
<!--                                <div class="input-number price-max">-->
<!--                                    <input id="price-max" name="price-max" type="number" value="9999999">-->
<!--                                    <span class="qty-up">+</span>-->
<!--                                    <span class="qty-down">-</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <!-- /aside Widget -->

                        <input type="submit" name="valider" value="VALIDER" />

                    </form>
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">

                        <!-- store products -->
                        <div class="row">
                            <?php
                            if(!empty($_SESSION['msg']['succes'])){
                                echo "<p class='alert btn-danger' id='alertbox' onclick=boxAlert()>";
                                echo "<strong>".$_SESSION['msg']['succes']."</strong>";
                                echo "</p>";
                                unset($_SESSION['msg']['succes']);
                                
                            }

                            ?>

                            <h3>Prouits</h3>

                            <?php
                            //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                            $listeArticles=(new ArticlesManager())->afficherTout();


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
                                <!-- product -->
                                <div class="col-md-4 col-xs-6">

                                    <!-- DEBUT product -->
                                    <div class="product">
                                        <form action="index.php?url=panier" method="post" enctype="multipart/form">


<!--                                            <input type="hidden" name="url" value="panier">-->

                                            <div class="product-img">
                                                <img src="public/img/<?= $article['PHOTO'] ?>" alt="Photo de l'article">
<!--                                                <img src="public/img/--><?//= $article['PHOTO_TITRE'] ?><!--" alt="Photo de l'article">-->
<!--                                                <img src="data:image/jpg;base64,--><?//= base64_encode($article['PHOTO_BIN']) ?><!--" width="150px"  alt="">-->


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
                        <!-- /store products -->

                    </div>
                    <!-- /STORE -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- ================================================================================== -->

<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>