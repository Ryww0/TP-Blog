
<div class="container-fluid>">
    <h2><?= $article->getTitre() ?></h2>
    <img src='<?= $article->getImage() ?>'>
    <p><?= $article->getContenu() ?></p>
</div>
<h4>Commentaire :</h4>
<?php
    /*
<div class="container-fluid>">
    <div>
        <p><?= $commentaire->getContenu() ?></p>
    </div>
</div>
