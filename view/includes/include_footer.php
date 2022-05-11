<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer" id="abboutus">
                        <h3 class="footer-title">A propos de nous</h3>
                        <p><?= $_SESSION['Entreprise']['Description'] ?></p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i><?= $_SESSION['Entreprise']['lieu'] ?></a></li>
                            <li><a href="tel:<?= $_SESSION['Entreprise']['tel'] ?>"><i class="fa fa-phone"></i><?= $_SESSION['Entreprise']['tel'] ?></a></li>
                            <li><a href="mailto:<?= $_SESSION['Entreprise']['mail'] ?>"><i class="fa fa-envelope-o"></i><?= $_SESSION['Entreprise']['mail'] ?></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Localisation</h3>
                        <ul class="footer-links">

                            <li>

                            </li>

                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Services d'achat-vente</h3>
                        <ul class="footer-links">
                            <li class="text text-danger">Tous achats est effectué au près de nos livreurs et bien sûr apres satisfaction du colis.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">
                            <?php if(!loginON()) : ?>
                                <li><a href="index.php?url=connexion"><i class="fa fa-user-o"></i> Connexion</a> | <a href="index.php?url=inscription"><i class="fa fa-address-book-o"></i> Inscription</a></li>
                            <?php else: ?>
                                <li><a href="index.php?url=profile&idClient=<?= $_SESSION['client']['id'] ?>"><i class="fa fa-user-md"></i> COMPTE DE <?= $_SESSION['client']['identifient'] ?></a></li>
                            <?php endif; ?>


                            <li><a href="index.php?url=panier">Votre Panier</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
							<span class="copyright">
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tout droit est réservé | Ce site d'ecommerce est conçu <i class="fa fa-heart-o" aria-hidden="true"></i> par des étudiants de <a href="https://www.google.com/search?tbs=lf:1,lf_ui:2&tbm=lcl&sxsrf=ALeKk03H90oL4I_Caw5HSP9X27YMhkieBg:1629506052053&q=miage+cote+d%27ivoire&rflfq=1&num=10&ved=2ahUKEwi67pCL78DyAhUDoVwKHRjwAmAQtgN6BAgGEAM" target="_blank">MIAGE</a>
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- jQuery Plugins -->
    <script src="public/js/jquery-3.6.0.min.js"></script>
    <!--script src="public/js/jquery.min.js"></script-->
    <script src="public/js/jquery.rateyo.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <script src="public/js/slick.min.js"></script>
    <script src="public/js/nouislider.min.js"></script>
    <script src="public/js/jquery.zoom.min.js"></script>
    <script src="public/js/main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("tabRecherche");
        filter = input.value.toUpperCase();
        table = document.getElementById("store");
        tr = table.getElementsByClassName("product");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByClassName("product");
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }




    </script>

    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

