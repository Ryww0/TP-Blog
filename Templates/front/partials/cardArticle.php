<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?= $article->getImage() ?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?= $article->getTitle() ?></h5>
        <p class="card-text" maxlength="150"><?= $article->getContenu() ?></p>
        <a href=<?= URL_ROOT.'/?'.$article->getId() ?> class="btn btn-primary">Lire</a>
    </div>
</div>