<?php $titre = "mini blog|mini blog,blog,astuce,astuces"; ?>
<?php ob_start(); ?>

    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div id="aside" class="col-md-6">
                    <h3>INSCRIPTION</h3>
                    <form method="post" action="" class="review-form">
                        <input type="hidden" name="action" value="inscription">
                        <input class="input" type="email" name="email" placeholder="votre Email">
                        <input class="input" type="text" name="contact" placeholder="votre contact">
                        <input class="input" type="text" name="nom" placeholder="votre Nom">
                        <input class="input" type="text" name="prenom" placeholder="Votre Prenom">
                        <input class="input" type="password" name="passe_code" placeholder="Votre Mot de Passe">


                        <button class="primary-btn" type="submit" name="enregistrer">S'inscrire</button>
                        <button class="primary-btn" type="reset" name="enregistrer">Annuler</button>
                        <br><br>
                        <p><a href="index.php?url=connexion"><i class="fa fa-user-o"></i> Connexion a votre compte</a></p>
                        <?php
                        if(!empty($_SESSION['msg']['erreur'])){
                            echo "<p class='btn btn-danger' id='alertbox' onclick=boxAlert()>".$_SESSION['msg']['erreur']."</p>";
                            unset($_SESSION['msg']['erreur']);
                        }
                        if(!empty($_SESSION['msg']['succes'])){
                            echo "<p class='btn btn-warning badge' id='alertbox' onclick=boxAlert()>".$_SESSION['msg']['succes']."</p>";
                            unset($_SESSION['msg']['succes']);
                        }

                        ?>
                    </form>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- ================================================================================== -->


<?php $content = ob_get_clean(); ?>

<?php @require('template.php'); ?>