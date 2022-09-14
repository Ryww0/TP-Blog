<?php

namespace App\Repository;

use App\Model\Article;
use App\Service\Database;

class ArticleRepository extends Database implements IArticleRepository
{
    public function add(Article $article): Article
    {
        $stmt = $this->db->prepare("INSERT INTO article (titre, image, contenu, date_creation, date_modif, id_user) 
                                          VALUES (:titre, :image, :contenu, :date_creation, :date_modif, :id_user)");
        $stmt->bindValue(':titre', $article->getTitre());
        $stmt->bindValue(':image', $article->getImage());
        $stmt->bindValue(':contenu', $article->getContenu());
        $stmt->bindValue(':date_creation', $article->getDate_creation());
        $stmt->bindValue(':date_modif', $article->getDate_modif());
        $stmt->bindValue(':id_user', $article->getId_user());
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
            $a = new Article();
            $a->setId($arr['id']);
            $a->setTitre($arr['titre']);
            $a->setImage($arr['image']);
            $a->setContenu($arr['contenu']);
            $a->setDate_creation($arr['date_creation']);
            $a->setDate_modif($arr['date_modif']);
            $a->setId_user($arr['Id_user']);
            $articles[] = $a;
        }
        return $articles;
    }

    public function findById($params): Article
    {
        $stmt = $this->db->prepare("SELECT * FROM article WHERE id = :id");
        $stmt->bindValue(':id', $params);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetch();
        if (!$arr) {
            throw new PDOException("Could not find id in database");
        }
        $article = new Article();
        $article->setId($arr['id']);
        $article->setTitre($arr['titre']);
        $article->setImage($arr['image']);
        $article->setContenu($arr['contenu']);
        $article->setDate_creation($arr['date_creation']);
        $article->setDate_modif($arr['date_modif']);
        $article->setId_user($arr['Id_user']);
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
        $article->setDate_creation($arr['date_creation']);
        $article->setDate_modif($arr['date_modif']);
        $article->setId_user($arr['Id_user']);
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
        $stmt->bindValue(':titre', $article->getNom());
        $stmt->bindValue(':image', $article->getArticle());
        $stmt->bindValue(':contenu', $article->getContenu());
        $stmt->bindValue(':date_modif', $article->getDate_modif());
        $stmt->bindValue(':id_user', $article->getId_user());
        $stmt->bindValue(':id', $article->getId());
        $stmt->execute();
        $stmt = null;
    }

    public function remove(Article $article)
    {
        $stmt = $this->db->prepare("DELETE FROM article WHERE id = :id");
        $stmt->bindValue(':id', $article->getId());
        $stmt->execute();
        $stmt = null;
    }
}
