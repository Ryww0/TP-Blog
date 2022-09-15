<?php
namespace App\Form;

use App\Service\Form;

class FormCommentaire
{
    public static function buildAddCommentaire()
    {
        $form = new Form();

        $form->debutForm('post', URL_ROOT . 'add')

            ->ajoutLabelFor('auteur', 'auteur')
            ->ajoutInput('auteur', 'auteur', ['id' => 'user', 'class' => 'form-control'])

            ->ajoutLabelFor('titre', 'titre')
            ->ajoutInput('titre', 'titre', ['id' => 'titre', 'class' => 'form-control'])

            ->ajoutLabelFor('contenu', 'contenu')
            ->ajoutInput('contenu', 'contenu', ['id' => 'contenu', 'class' => 'form-control'])

            ->ajoutBouton('Ajouter un article', ['class' => 'btn btn-primary'])
            ->finForm();
        return $form;
    }
}