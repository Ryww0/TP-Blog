<?php

namespace App\Controller\front;

use App\Service\View;

use App\Repository\ArticleRepository;

class ArticleController
{
    use View;

    private ArticleRepository $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

    public function show($id_article)
    {
        $article = $this->articleRepository->findById($id_article);
        return $this->render(
            SITE_NAME . ' - ' . $article->getTitre(),
            'front/pages/article.php',
            [
                'article' => $article,
                'commentaires' => $this->commentaireRepository->fectchAllCommentsByArticleId(),
//                'formComment' => FormCommentaire::builCreateComment()
            ]);
    }
}