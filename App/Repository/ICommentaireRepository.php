<?php
namespace App\Repository;

use App\Model\Comment;

interface ICommentaireRepository
{
    public function add(Comment $commentaire): void;

    public function fetchAll(): array;

    public function fecthAllByIdArticle($params): array;

    public function remove(Comment $commentaire);
}
