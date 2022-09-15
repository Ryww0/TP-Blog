<?php

namespace App\Controller\back;

use App\Model\Comment;
use App\Service\Input;
use App\Service\Redirect;
use App\Service\View;

use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;

use App\Validator\Validation;

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

    public function invoke()
    {
        return $this->render(
            SITE_NAME . ' - Articles',
            'back/admin.php',
            [
                'articles' => $this->articleRepository->fetchAll()
            ]);
    }

    public function removeById($params)
    {
        $article = $this->articleRepository->findById($params);
        $this->articleRepository->remove($article);
        Redirect::to('admin/admin.php');
    }

    public function UpdateArticleById($params)
    {
        if (Input::exists()) {
            $val = new Validation;
            $val->name('titre')->value(Input::get('titre'))->pattern('words')->required();
            $val->name('contenu')->value(Input::get('contenu'))->pattern('words')->required();
            if ($val->isSuccess()) {
                $article = $this->articleRepository->findById($params);
                $article->setTitre(Input::get('titre'));
                $this->articleRepository->update($article);
                Redirect::to('admin/admin.php');
            }
        }
    }

    public function showArticleById($params)
    {
        return $this->render(
            SITE_NAME . ' - Articles',
            'back/admin.php',
            [
                'article' => $this->articleRepository->findById($params),
                'commentaires' => $this->commentaireRepository->findById($params)

            ]);
    }

    // TODO
    public function addArticle()
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
                SITE_NAME . ' - Add article: ',
                'back/admin.php',
                [
                    'formArticle' => FormArticle::buildCreateForm(),
                ]);
        }

    }
}