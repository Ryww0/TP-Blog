<?php
namespace App\Repository;

use App\Model\Comment;

interface ICommentaireRepository
{
    public function add(Comment $commentaire): Comment;

    public function fetchAll(): array;

    public function findById($params): Comment;

    public function remove(Comment $commentaire);
}
