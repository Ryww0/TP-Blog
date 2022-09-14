<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Tout les articles :</h1>
            <?php
            foreach ($articles as $key => $article) {
                include 'cardArticle.php';
            }
            ?>
        </div>
    </div>
</div>