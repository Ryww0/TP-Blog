<?php

namespace App\Controller\back;

use App\Service\View;

use App\Repository\CommentaireRepository;

class CommentaireController
{
    use View;

    private CommentaireRepository $commentaireRepository;

    public function __construct()
    {
        $this->commentaireRepository = new CommentaireRepository();
    }

    public function showCommentsByArticleId($params)
    {
        return $this->render(
            SITE_NAME . ' - Articles',
            'front/pages/article.php',
            [
                'commentaires' => $this->commentaireRepository->findById($params)
            ]);
    }

    public function deleteCommentById($params)
    {
        $commentaire = $this->commentaireRepository->findById($params);
        $this->commentaireRepository->remove($commentaire);
        Redirect::to('back/admin.php');
    }
}