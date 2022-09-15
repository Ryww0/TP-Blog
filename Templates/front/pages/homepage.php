<div class="container">
    <div class="row">
        <h1>Tout les articles :</h1>
        <div class="col-12 d-flex flex-wrap justify-content-between">
            <?php
            foreach ($articles as $key => $article) {
                include APP_ROOT . '/Templates/front/partials/cardArticle.php';
            }
            ?>
        </div>
    </div>
</div>