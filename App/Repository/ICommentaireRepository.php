<?php
namespace App\Repository;

use App\Model\Comment;

interface ICommentaireRepository
{
    public function add(Commentaire $commentaire): Commentaire;

    public function fetchAll(): array;

    public function findById($params): Commentaire;

    public function remove(Commentaire $commentaire);
}
