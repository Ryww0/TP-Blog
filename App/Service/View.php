<?php

namespace App\Service;

trait View
{
    function render($title = '', $file, $variables = [], $layout = APP_ROOT . '/Templates/front/partials/bases.php')
    {
        $content = $this->renderContent($file, $variables);
        ob_start();
        include $layout;
        return ob_get_clean();
    }

    function renderContent($file, $variables = [])
    {
        extract($variables);
        ob_start();
        include APP_ROOT . '/Templates/' . $file;
        return ob_get_clean();
    }
}