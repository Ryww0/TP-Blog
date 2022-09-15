<?php

namespace App\Controller\front;

use App\Repository\CommentaireRepository;
use App\Service\View;

use App\Repository\ArticleRepository;

class ArticleController
{
    use View;

    private ArticleRepository $articleRepository;
    private CommentaireRepository $commentaireRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->commentaireRepository = new CommentaireRepository();
    }

    public function show($id_article)
    {
        $article = $this->articleRepository->findById($id_article);
        $commentaires = $this->commentaireRepository->findById($id_article);
        return $this->render(
            SITE_NAME . ' - ' . $article->getTitre(),
            'front/pages/article.php',
            [
                'article' => $article,
                'commentaires' => $commentaires,
//                'formComment' => FormCommentaire::builCreateComment()
            ]);
    }
}