<?php $titre = "Ecommerce | Page pour retrouver identifient"; ?>
<?php ob_start(); ?>

    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div id="aside" class="col-md-6">
                    <h3>DEMANDE IDENTIFIENT</h3>
                    <form class="review-form" action="" method="post">
                        <input type="hidden" name="action" value="retrouveIdentifient" />
                        <!--<p><input class="input" type="email" placeholder="Votre Email"></p>-->
                        <p><input class="input" name="email" type="text" value="<?php if (isset($_POST['email']) )echo $_POST['email']; ?>" placeholder="Votre Email qui a servir lors de votre insription"></p>

                        <button class="primary-btn" type="submit">chercher identifient</button>
                        <br><br>

                        <p><a href="index.php?url=connexion"><b>Connexion au compte</b> </a></p>
                        <br><br>
                        <?php if(isset($_SESSION['msg']['succes'])): ?>
                        <h3>Vos informations d'identification</h3>
                            <p>Votre Identifient : <?= $_SESSION['msg']['succes']['mail']; ?></p>
                            <br>
                            <p>Votre mot de passe : <?= $_SESSION['msg']['succes']['motpasse']; ?></p>
                        <?php endif; unset($_SESSION['msg']['succes']); ?>

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