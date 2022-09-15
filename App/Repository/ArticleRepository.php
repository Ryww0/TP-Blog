<?php

namespace App\Repository;

use PDO;
use PDOException;
use App\Service\Database;
use App\Model\Article;

class ArticleRepository extends Database implements IArticleRepository
{
    public function add(Article $article): Article
    {
        $stmt = $this->db->prepare("INSERT INTO article (titre, image, contenu, date_creation, date_modif, id_user) 
                                          VALUES (:titre, :image, :contenu, :date_creation, :date_modif, :id_user)");
        $stmt->bindValue(':titre', $article->getTitre());
        $stmt->bindValue(':image', $article->getImage());
        $stmt->bindValue(':contenu', $article->getContenu());
        $stmt->bindValue(':date_creation', $article->getDateCreated());
        $stmt->bindValue(':date_modif', $article->getDateUpdated());
        $stmt->bindValue(':id_user', $article->getIdUser());
        $stmt->execute();
        $stmt = null;
        return $this->findById($this->db->lastInsertId());
    }

    public function fetchAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM article ORDER BY titre ASC ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetchAll();
        if (!$arr) {
            throw new PDOException("Could not find user in database");
        }
        $stmt = null;
        $articles = [];
        foreach ($arr as $article) {
            $a = new Article($article['titre'], $article['image'], $article['id_user']);
            $a->setId($article['id_article']);
            $a->setContenu($article['contenu']);
//            $a->getDateCreated($article['date_creation']);
//            $a->getDateUpdated($article['date_modif']);
            $articles[] = $a;
        }
        return $articles;
    }

    public function findById($params): Article
    {
        $stmt = $this->db->prepare("SELECT * FROM article WHERE id_article = :id");
        $stmt->bindValue(':id', $params);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetch();
        if (!$arr) {
            throw new PDOException("Could not find id in database");
        }
        $article = new Article($arr['titre'], $arr['image'], $arr['id_user']);
        $article->setId($arr['id_article']);
        $article->setContenu($arr['contenu']);
        //$article->setDateCreated($arr['date_creation']);
        // $article->setDateUpdated($arr['date_modif']);
        return $article;
    }

    public function findByTitre(string $titre): Article
    {
        $stmt = $this->db->prepare("SELECT * FROM titre WHERE titre = :titre");
        $stmt->bindValue(':titre', $titre);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetch();
        if (!$arr) {
            throw new PDOException("Could not find article in database");
        }
        $stmt = null;
        $article = new Article();
        $article->setId($arr['id']);
        $article->setTitre($arr['titre']);
        $article->setImage($arr['image']);
        $article->setContenu($arr['contenu']);
        $article->setDateCreated($arr['date_creation']);
        $article->setDateUpdated($arr['date_modif']);
        $article->setIdUser($arr['Id_user']);
        return $article;
    }

    public function update(Article $article)
    {
        $stmt = $this->db->prepare("UPDATE article 
                                          SET titre = :titre,
                                              image = :image,
                                              contenu = :contenu,
                                              date_modif = :date_modif,
                                              id_user = :id_user
                                          WHERE id = :id");
        $stmt->bindValue(':titre', $article->getTitre());
        $stmt->bindValue(':image', $article->getImage());
        $stmt->bindValue(':contenu', $article->getContenu());
        $stmt->bindValue(':date_modif', $article->getDateUpdated());
        $stmt->bindValue(':id_user', $article->getIdUser());
        $stmt->bindValue(':id', $article->getIdArticle());
        $stmt->execute();
        $stmt = null;
    }

    public function remove(Article $article)
    {
        $stmt = $this->db->prepare("DELETE FROM article WHERE id_article = :id");
        $stmt->bindValue(':id', $article->getIdArticle());
        $stmt->execute();
        $stmt = null;
    }
}