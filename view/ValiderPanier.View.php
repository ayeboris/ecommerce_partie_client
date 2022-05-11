<?php $titre = "Ecommerce | Site de vente"; ?>
<?php ob_start(); ?>


    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <?php if(isset($_SESSION['client']['id'])): ?>
            <!-- row -->
            <div class="row">

                <div class="col col-md-8" >
                    <h3>Coordonnees pour votre livraison</h3>
                    <br>
                    <div id="aside" class="col-md-8">
                        <h3>Information pour le retrait de votre achat</h3>
                        <form class="review-form" action="index.php?url=valider" method="post">

                            <input type="hidden" name="action" value="validerCommande" />

                            <input type="hidden" name="idClient" value="<?= $_SESSION['client']['id'] ?>">

                            <p><input class="input" name="destination" type="text" value="<?php if (isset($_POST['destination']) )echo $_POST['destination']; ?>" placeholder="Ou voulez-vous recevoir votre produit exactement?"></p>
                            <p><input class="input" name="lieudestination" type="text" value="<?php if (isset($_POST['lieudestination']) )echo $_POST['lieudestination']; ?>" placeholder="Plus de precision?"></p>
                            <p><input class="input" name="datecommande" type="date" value="<?php if (isset($_POST['datecommande']) )echo $_POST['datecommande']; ?>" placeholder="Quand voulez-vous recevoir?"></p>

                            <button class="primary-btn" type="submit">Faire votre commande</button>

                            <?php
                            if(!empty($_SESSION['msg']['erreur'])){
                                echo "<p id='alertbox' onclick=boxAlert()>".$_SESSION['msg']['erreur']."</p>";
                                unset($_SESSION['msg']['erreur']);
                            }

                            ?>
                        </form>
                    </div>

                </div>

                <div class="card col col col-md-4" >

                    <div class="section">
                        <h3 class="section-title">Facture</h3>
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
                                </thead>
                                <!--Table head-->

                            </table>
                            <!--Table-->
                        </div>
                        <div>
                            <h5>FRAIS DE LIVRAISON</h5>
                            <i>TOUT FRAIS DE LIVRAISON N'EST PAS INCLUS</i>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /row -->
        <?php else: ?>
            <h3>VOUS DEVEZ ETRE MEMBRE DU SITE ET VOUS DEVEZ ETRE CONNECTE POUR VALIDER VOTRE COMMANDE</h3>
                <a class="btn btn-info"href="index.php?url=connexion">Connexion a votre compte</a>
                <a class="btn btn-danger" href="index.php?url=inscription">Creer un compte</a>
        <?php endif; ?>
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- ================================================================================== -->


<?php $content = ob_get_clean(); ?>

<?php require 'template.php'; ?>