<?php
namespace App\Form;

use App\Model\Article;
use App\Service\Form;

class FormCommentaire
{
    public static function buildAddCommentaire(Article $article)
    {
        $form = new Form();

        $form->debutForm('post', URL_ROOT . 'commentaire/add/'.$article->getIdArticle())

//            ->ajoutLabelFor('id_user')
            ->ajoutInput('text', 'id_user')

            ->ajoutLabelFor('contenu', 'contenu')
            ->ajoutInput('text', 'contenu', ['id' => 'contenu', 'class' => 'form-control'])

            ->ajoutBouton('Ajouter un article', ['class' => 'btn btn-primary'])
            ->finForm();
        return $form;
    }
}