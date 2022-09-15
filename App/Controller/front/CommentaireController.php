<?php

namespace App\Controller\front;

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
    public function addComment($id_article)
    {
        if (Input::exists()) {
            $val = new Validation;
            $val->name('contenu')->value(Input::get('contenu'))->pattern('words')->required();
            $val->name('id_user')->value(Input::get('id_user'))->pattern('int')->required();
            if ($val->isSuccess()) {
                $contenu = Input::get('contenu');
                $idUser = Input::get('id_user');
                $comment = new Comment($idUser,$id_article);
                $comment->setContenu($contenu);
                $this->commentaireRepository->add($comment);
                Redirect::to('/article/'. $id_article);
            }
        }
    }

    public function deleteCommentById($params)
    {
        $commentaire = $this->commentaireRepository->findById($params);
        $this->commentaireRepository->remove($commentaire);
        Redirect::to('back/admin.php');
    }
}