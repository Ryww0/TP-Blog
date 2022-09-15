<?php

namespace App\Controller\back;

use App\Service\Input;
use App\Service\Redirect;
use App\Service\View;

use App\Repository\CommentaireRepository;
use App\Validator\Validation;

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
            'back/admin.php',
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