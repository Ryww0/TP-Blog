<?php

namespace App\Controller\front;

use App\Service\View;
use App\Repository\ArticleRepository;

class HomeController
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
}