<?php $titre = "Ecommerce | Site de vente"; ?>
<?php ob_start(); ?>


    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div id="aside" class="col-md-8">
                    <h3>Valider votre paiement</h3>
                    <form class="review-form" src="" method="post">
                        <input class="input" type="text" name="destination" placeholder="Destination">
                        <input class="input" type="text" name="lieudestination" placeholder="lieu de destination">
                        <input class="input" type="text" name="datelivraison" placeholder="date de livraison">
                        <button class="primary-btn">Paier</button>
                    </form>
                </div>
                <div id="aside" class="col-md-4">
                    <h3>Votre Achat</h3>
                    <table class="table">
                        <tr>
                            <td>Sous-Total</td>
                            <td>101001 FCFA</td>
                        </tr>
                        <tr>
                            <td>TVA</td>
                            <td>101001 FCFA</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>101001 FCFA</td>
                        </tr>
                    </table>

                    <h3>Info de livraison</h3>
                    <p>Votre achat sera paié apres satisfaction et reception au pres de notre livreur ou livreuse.</p>

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