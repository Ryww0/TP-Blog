
<div class="container-fluid>">
    <h2><?= $article->getTitle() ?></h2>
    <img src='<?= $article->getImage() ?>'>
    <p><?= $article->getContenu() ?></p>
</div>
<h4>Commentaire :</h4>
<div class="container-fluid>">
    <div>
        <p><?= $commentaire->getContenu() ?></p>
    </div>
</div>
