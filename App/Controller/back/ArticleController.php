<?php

namespace App\Controller\back;

use App\Service\Input;
use App\Service\Redirect;
use App\Service\View;

use App\Repository\ArticleRepository;
use App\Validator\Validation;

class ArticleController
{
    use View;

    private ArticleRepository $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
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

    public function UpdateById($params)
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
}