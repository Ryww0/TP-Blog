<?php

namespace App\Form;

use App\Service\Form;
use App\Model\Article;


class FormArticle
{
    public static function buildAddArticle()
    {
        $form = new Form();

        $form->debutForm('post', URL_ROOT . 'add')

            ->ajoutLabelFor('auteur', 'auteur')
            ->ajoutInput('auteur', 'auteur', ['id' => 'auteur', 'class' => 'form-control'])

            ->ajoutLabelFor('titre', 'titre')
            ->ajoutInput('titre', 'titre', ['id' => 'titre', 'class' => 'form-control'])

            ->ajoutLabelFor('contenu', 'contenu')
            ->ajoutInput('contenu', 'contenu', ['id' => 'contenu', 'class' => 'form-control'])

            ->ajoutBouton('Ajouter un article', ['class' => 'btn btn-primary'])
            ->finForm();
        return $form;
    }

    public static function buildUpdateFormWithArticle(Article $article): Form
    {
        $form = new Form();
        $form->debutForm('post', URL_ROOT . 'admin/article/update/' . $article->getIdArticle() )

            ->ajoutLabelFor('auteur', 'auteur')
            ->ajoutInput('auteur', 'auteur', ['id' => 'auteur', 'class' => 'form-control'])

            ->ajoutLabelFor('titre', 'titre')
            ->ajoutInput('titre', 'titre', ['id' => 'titre', 'class' => 'form-control'])

            ->ajoutLabelFor('contenu', 'contenu')
            ->ajoutInput('contenu', 'contenu', ['id' => 'contenu', 'class' => 'form-control'])

            ->ajoutBouton('Ajouter un article', ['class' => 'btn btn-primary'])
            ->finForm();
        return $form;
    }

    public static function buildDeleteFormWithSport($article): Form
    {
        $form = new Form();
        $form->debutForm('post', URL_ROOT . 'admin/article/delete/' .$article->getIdArticle())
            ->ajoutBouton('Delete', ['class' => 'btn btn-danger'])
            ->finForm();
        return $form;
    }
}