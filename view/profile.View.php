<?php $titre = "Ecommerce | Page de connexion"; ?>
<?php ob_start(); ?>

    <!-- ================================================================================== -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div id="aside" class="col-md-12">
                    <h3>Information du Client</h3>

                    <?php
                    if(!isset($_POST['modifierCompte']) && !isset($_POST['modifierCompteAction']) ):

                        $result=(new ClientsManager())->afficherUn($_SESSION['client']['id']);

                        ?>
                    <form method="post" action="" class="review-form">

                        <input class="input" type="hidden" name="IdClient" value="<?= $result['CODECL'] ?>" placeholder="votre Email">

                        <input class="input" disabled="disabled" type="email" name="email" value="<?= $result['EMAIL'] ?>" placeholder="votre Email">
                        <input class="input" disabled="disabled" type="text" name="contact" value="<?= $result['CONTACT'] ?>"  placeholder="votre contact">
                        <input class="input" disabled="disabled" type="text" name="nom" value="<?= $result['NOM'] ?>"  placeholder="votre Nom">
                        <input class="input" disabled="disabled" type="text" name="prenom" value="<?= $result['PRENOM'] ?>"  placeholder="Votre Prenom">
                        <input class="input" disabled="disabled" type="text" name="DATE_ABONNE" value="<?= $result['DATE_ABONNE'] ?>"  placeholder="Date abonnement">

                        <?php if(isset($_POST['VoirCodeIdentifient'])): ?>
                        <p><b>Mot de passe, passez sur la barre en dessous</b></p>
                        <input class="input btn-danger" disabled="disabled" type="text" name="PASSE_CODE" value="<?= $result['PASSE_CODE'] ?>"  placeholder="MOT DE PASSE DU CLIENT">
                        <?php endif; ?>
                        <button class="primary-btn" type="submit" name="modifierCompte">MODIFIER LE COMPTE</button>

                        <a href="index.php?url=profile&action=supprimerCompteAction&idClient=<?= $_SESSION['client']['id'] ?>" class=" primary-btn btn-warning">Suprrimer le compte</a>

                        <?php if(!isset($_POST['VoirCodeIdentifient'])): ?>
                        <button name="VoirCodeIdentifient" class=" primary-btn btn-danger">Voir le mot de passe du compte</button>
                        <?php endif; ?>
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
                    <?php else:
                        $result=(new ClientsManager())->afficherUn($_SESSION['client']['id']);

                        ?>

                    <form method="post" action="" class="review-form">

                        <input type="hidden" name="action" value="modifierCompteAction">
                        <input class="input" type="hidden" name="IdClient" value="<?= $result['CODECL'] ?>" placeholder="IDENTIFIENT CLIENT">
                        <label for="email">Email</label>
                        <input class="input" id="email" type="email" name="email" value="<?= $result['EMAIL'] ?>" placeholder="votre Email">
                        <label for="contact">Contact</label>
                        <input class="input" id="contact" type="text" name="contact" value="<?= $result['CONTACT'] ?>"  placeholder="votre contact">
                        <label for="nom">NOM</label>
                        <input class="input" id="nom" type="text" name="nom" value="<?= $result['NOM'] ?>"  placeholder="votre Nom">
                        <label for="prenom">prenom</label>
                        <input class="input" id="prenom" type="text" name="prenom" value="<?= $result['PRENOM'] ?>"  placeholder="Votre Prenom">
                        <label class="disabled">dateAbonne</label>
                        <input class="input disabled-block"  disabled="disabled" type="text" name="DATE_ABONNE" value="<?= $result['DATE_ABONNE'] ?>"  placeholder="Date abonnement">

                        <button class="primary-btn" type="submit" name="modifierCompteAction">MODIFIER</button>

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

                        <?php endif; ?>
                </div>

            </div>
            <!-- /row -->

            <div class="row">
                <div class="card col col-md-12" >

                    <div class="section">
                        <h3 class="section-title">Vos commandes</h3>
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
                                        <h5>Date Livraison</h5>
                                    </th>
                                    <th>
                                        Liste de vos Articles
                                    </th>

                                    <th>
                                        ETAT
                                    </th>
                                </tr>

                        <!--         LISTE DES INFOS DE COMMANDE                       -->
                                <?php
                                //Appel de la classe PDO neccessaire et Appel de la FONCTION Communiauant avec la BD
                                $listeCommande= (new CommandesManager())->afficherToutSelonClient($_SESSION['client']['id']);
//                                verification($listeCommande);

                                foreach($listeCommande as $commande) :

                                    ?>
                                <tr>
                                    <td><?= $commande['DESTINATION'] ?></td>
                                    <td><?= $commande['DATELIVRAISON'] ?></td>
                                    <td>

                                        <a href="index.php?url=listeArticleCommande&NumCom=<?= $commande['NUMCOM'] ?>">Voir Les articles</a>
                                    </td>
                                    <td>
                                        <div class="row">

                                            <?php if($commande['etats']==1): ?>
                                                <p class="badge bg-green">active</p>
                                                <span><a class=" bg-yellow" href="index.php?url=profile&actuEtat=<?= $commande['etats'] ?>&action=actuEtats&NumCom=<?= $commande['NUMCOM'] ?>">Annuler la commande</a></span>
                                            <?php elseif($commande['etats']==0): ?>
                                                <p class="badge">desactive</p>
                                                <span><a class=" bg-yellow" href="index.php?url=profile&actuEtat=<?= $commande['etats'] ?>&action=actuEtats&NumCom=<?= $commande['NUMCOM'] ?>">Reativer la commande</a></span>
                                            <?php endif; ?>
                                        </div>
                                        <h5><a class="alert" href="index.php?url=profile&action=supprimerCommande&NumCom=<?= $commande['NUMCOM'] ?>">Supprimer la commande</a></h5>

                                    </td>

                                </tr>

                                    <?php endforeach; ?>
                                </thead>
                                <!--         LISTE DES INFOS DE COMMANDE                       -->

                            </table>
                            <!--Table-->
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