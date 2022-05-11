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
<!--                            <div class="aside">-->
<!--                                <h3 class="aside-title">PRIX</h3>-->
<!--                                <div class="price-filter">-->
<!--                                    <div id="price-slider"></div>-->
<!--                                    <div class="input-number price-min">-->
<!--                                        <input id="price-min" name="price-min" type="number"  value="1">-->
<!--                                        <span class="qty-up">+</span>-->
<!--                                        <span class="qty-down">-</span>-->
<!--                                    </div>-->
<!--                                    <span>-</span>-->
<!--                                    <div class="input-number price-max">-->
<!--                                        <input id="price-max" name="price-max" type="number" value="9999999">-->
<!--                                        <span class="qty-up">+</span>-->
<!--                                        <span class="qty-down">-</span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <!-- /aside Widget -->

                            <input type="submit" name="valider"  value="VALIDER" />

                    </form>
                </div>
                <!-- /ASIDE -->


                <!-- STORE -->
                <div id="store" class="col-md-9">
                        <?php  if( isset($_POST['valider']) ): ?>
                        <!-- store products -->
                        <div class="row">
                            <?php if(isset($_POST['recherche'])): ?>
                                <h3>Resultat de votre recherche <?= $_POST['recherche'] ?></h3>
                            <?php endif; ?>

                            <?php

                            $_SESSION['result'] =array();
                            if (isset($_POST['asideRechercher'])){

                                $_POST['idcategorie']=!empty($_POST['idcategorie'])?$_POST['idcategorie']: "";
//                                var_dump($_POST['idcategorie']);

                                $_SESSION['idcategorie']=$_POST['idcategorie'];
                                //unset($_SESSION['idcategorie']);
                                $_POST['idmarque']=!empty($_POST['idmarque'])?$_POST['idmarque']:"";
//                                var_dump($_POST['idmarque']);

                                $_SESSION['idmarque']=$_POST['idmarque'];
                                //unset($_SESSION['idmarque']);

                                // ON favorise laisser le prix des vehicules, Pour un developpement future
//                                var_dump($_POST['price-min']);
//                                $_POST['price-min']=!empty($_POST['price-min'])?$_POST['price-min']:'';
//
//                                var_dump($_POST['price-max']);
//                                $_POST['price-max']=$_POST['price-max']?!empty($_POST['price-max']):'';


                                //Cas de marque uniquement
                                if (!empty($_POST['idmarque'])){
                                    $listeArticles=(new ArticlesManager())->rechercherselonAsideSelonMarque($_SESSION['idmarque'] );
                                    $_SESSION['result']=$listeArticles;
                                }
                                //Cas de categorie seulement
                                if (!empty($_SESSION['idcategorie'])){
                                    $listeArticles=(new ArticlesManager())->rechercherselonAsideSelonCategorie($_SESSION['idcategorie'] );
                                    $_SESSION['result']=$listeArticles;
                                }

                                //Cas de categorie et marque
                                if (!empty($_SESSION['idcategorie']) && !empty($_SESSION['idmarque']) || empty($_SESSION['idcategorie']) && empty($_SESSION['idmarque'])){
                                    $listeArticles=(new ArticlesManager())->rechercherselonAside($_SESSION['idmarque'],$_SESSION['idcategorie'] );
                                    $_SESSION['result']=$listeArticles;
                                }

                                if (empty($_POST['barRechercher'])){
                                    $_POST['recherche']='';

                                }
                            }

                            if (isset($_POST['barRechercher'])){
                                //Effecer la precedente recherche
                                unset($_SESSION['recherche']);

                                $_POST['recherche']=!empty($_POST['recherche']) ? $_POST['recherche'] :'';
                                //Sauvegarder la nouvelle recherche
                                $_SESSION['recherche']=$_POST['recherche'];

                                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                                $listeArticles=(new ArticlesManager())->rechercherselonBarRecherche("%".strtoupper($_SESSION['recherche'])."%");
                                $_SESSION['result']=$listeArticles;

                                if (empty($_POST['asideRechercher'])){
                                    $_POST['idcategorie']='';
                                    $_POST['idmarque']='';
                                    $_POST['price-min']='';
                                    $_POST['price-max']='';
                                }

                            }


                            //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                            //$listeArticles=(new ArticlesManager())->afficherTout();

//                            var_dump($listeArticles);

                            foreach($_SESSION['result'] as $article){

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

                        <?php  else: ?>
                        <h3>ERREUR DANS LE CODE</h3>
                            <?php

                            var_dump($_POST['idcategorie']);
                            var_dump($_POST['idmarque']);

                            ?>
                        <?php  endif; ?>

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