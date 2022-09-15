
<div class="container-fluid>">
    <h2><?= $article->getTitre() ?></h2>
    <img src='<?= $article->getImage() ?>'>
    <p><?= $article->getContenu() ?></p>
</div>
<h4>Commentaire :</h4>
<div class="container-fluid>">
    <div>
        <?php foreach ($commentaires as $key => $commentaire) { ?>
        <p><?= $commentaire->getContenu() ?></p>
        <?php } ?>
    </div>
</div>
