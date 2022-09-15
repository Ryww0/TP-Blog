<?php

namespace App\Controller\back;

use App\Service\Input;
use App\Service\Redirect;
use App\Service\View;

use App\Model\Comment;

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

    // TODO
    public function addComment($params)
    {
        if (Input::exists()) {
            var_dump($_POST);
            $val = new Validation;
            $val->name('contenu')->value(Input::get('contenu'))->pattern('words')->required();
            $val->name('id_user')->value(Input::get('id_user'))->pattern('int')->required();
            $val->name('id_article')->value(Input::get('id_article'))->pattern('int')->required();
            if ($val->isSuccess()) {
                $idUser = Input::get('id_user');
                $idArticle = Input::get('id_article');
                $comment = new Comment($idUser,$idArticle);
                $this->commentaireRepository->add($comment);
                Redirect::to('back/admin.php');
            }
        } else {
            return $this->render(
                SITE_NAME . ' - Add comm: ',
                'back/admin.php',
                [
                    'formComment' => FormComment::buildCreateForm(),
                ]);
        }

    }

    public function deleteCommentById($params)
    {
        $commentaire = $this->commentaireRepository->findById($params);
        $this->commentaireRepository->remove($commentaire);
        Redirect::to('back/admin.php');
    }
}