<?php
namespace App\Repository;

use App\Model\Article;

interface IArticleRepository
{
public function add(Article $article): Article;

public function fetchAll(): array;

public function findById($params): Article;

public function findByTitre(string $titre): Article;

public function update(Article $article);

public function remove(Article $article);
}
