<?php

namespace App\Controller\back;

use App\Service\Redirect;
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

    public function invoke()
    {
        return $this->render(
            SITE_NAME . ' - Articles',
            'front/pages/homepage.php',
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
}