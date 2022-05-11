<?php $titre = "Ecommerce | Page de connexion"; ?>
<?php ob_start(); ?>

    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div id="aside" class="col-md-6">
                    <h3>CONNEXION</h3>
                    <form class="review-form" action="" method="post">
                        <input type="hidden" name="action" value="connexion" />
                        <!--<p><input class="input" type="email" placeholder="Votre Email"></p>-->
                        <p><input class="input" name="email" type="text" value="<?php if (isset($_POST['email']) )echo $_POST['email']; ?>" placeholder="Votre identifient"></p>
                        <p><input class="input" name="motpasse" type="password" placeholder="Votre mot de passe"></p>
                        <p><a href="index.php?url=retrouveIdentifient"><i class="fa fa-address-book-o"></i><b> Identifient perdu</b> Cliquez ici </a></p>

                        <button class="primary-btn" type="submit">Se connecter</button>
                        <br><br>
                        <p><a href="index.php?url=inscription"><b>Creer votre compte</b> si vous ne disposez pas</a></p>
                        <?php
                        if(!empty($_SESSION['msg']['erreur'])){
                            echo "<p class='btn btn-danger' id='alertbox' onclick=boxAlert()>".$_SESSION['msg']['erreur']."</p>";
                            unset($_SESSION['msg']['erreur']);
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

<?php require 'template.php'; ?>