<?php $titre = "Ecommerce | Page de connexion"; ?>
<?php ob_start(); ?>

    <!-- ================================================================================== -->


    <!-- SECTION -->
    <div class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="index.php?url=index">Accueil</a> > <a href="index.php?url=profile&idClient=<?= $_SESSION['client']['id'] ?>"><i class="fa fa-user-md"></i> Profile de <?= $_SESSION['client']['identifient'] ?></a></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->

            <div class="row">
                <div class="card col col-md-12" >

                    <div class="section">
                        <h3 class="section-title">LA LISTE DE VOS ARTICLES COMMANDES</h3>
                        <div class="table-responsive">
                            <!--Table-->
                            <table class="table table-striped">

                                <!--Table head-->
                                <thead>
                                <tr>
                                    <th>
                                        <h5>#</h5>
                                    </th>
                                    <th>
                                        <h5>Detail du colis</h5>
                                    </th>
                                    <th>
                                        Detail de la commande
                                    </th>
                                    <th>
                                        MESSAGES
                                    </th>
                                </tr>

                                <!--         LISTE DES INFOS DE COMMANDE                       -->
                                <?php
                                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                                $listeCommande= (new ArticlesManager())->listeArticleParCommande($_SESSION['client']['id'],$_GET['NumCom']);
//                                verification($listeCommande);

                                foreach($listeCommande as $commande) :

                                    ?>
                                    <tr>
                                        <td><img width="200" src="public/img/<?= $commande['PHOTO'] ?>" alt=""></td>
                                        <td>
                                            <p> <b><?= $commande['TITRE'] ?></b></p>
                                            <p><i><?= $commande['date_publication'] ?></i></p>

                                        </td>
                                        <td>
                                           <p>Qte : <?= $commande['QUANTITE'] ?></p>
                                            <p><b><?= $commande['SOUSTOTAL'] ?></b> Fcfa</p>
                                        </td>
                                        <td>
                                            <h5><a class="btn btn-warning bg-yellow" href="index.php?url=detail&idArticle=<?= $commande['CODEART'] ?>">Laisser un commentaire</a></h5>


                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                                </thead>
                                <!--         LISTE DES INFOS DE COMMANDE                       -->

                            </table>
                            <!--Table-->
                            <div class="cart">

                                <?php
                                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                                $SommelisteCommande= (new ArticlesManager())->SommeArticlesCommandeParClientEtNumComm($_SESSION['client']['id'],$_GET['NumCom']); ?>
                                <h2 style="text-align:center;color:#ff2a2a;font-family:inherit;">
                                    <u>Total de la commande</u><br><br>
                                    <?php if(!empty($SommelisteCommande[0])) : ?>
                                    <?= $SommelisteCommande[0] ?> FCFA
                                    <?php else : ?>
                                    0 FCFA
                                    <?php endif; ?>
                                </h2>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- ================================================================================== -->

<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>