<?php $titre = "mini blog|mini blog,blog,astuce,astuces"; ?>
<?php ob_start(); ?>

    <a href="?url=index">accueil</a>

<section>
    <div class="container">
        <h1>LES ERREURS SURVENUS SONT</h1>
        <h3><?= $errors ?></h3>
        <img src="public/img/shop01.png" alt="img">
        <center><a href="?url=index">accueil</a></center>
    </div>
    
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>