<?php

namespace App\Repository;

use PDO;
use PDOException;
use App\Service\Database;
use App\Model\Comment;

class CommentaireRepository extends Database implements ICommentaireRepository
{
    public function add(Comment $commentaire): Comment
    {
        $stmt = $this->db->prepare("INSERT INTO commentaire (contenu, date_created, id_user, id_article)
                                          VALUES (:contenu, :date_created, :id_user, :id_article)");
        $stmt->bindValue(':contenu', $commentaire->getContenu());
        $stmt->bindValue(':date_created', $commentaire->getDateCreated());
        $stmt->bindValue(':id_user', $commentaire->getIdUser());
        $stmt->bindValue(':id_article', $commentaire->getIdArticle());
        $stmt->execute();
        $stmt = null;
        return $this->findById($this->db->lastInsertId());
    }

    public function  fetchAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM commentaire ORDER BY date_created DESC ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetchAll();
        if (!$arr) {
            throw new PDOException("Could not find commentaire in database");
        }
        $stmt = null;
        $commentaires = [];
        foreach ($arr as $commentaire) {
            $c = new Comment($commentaire['id_user'], $commentaire['id_article']);
            $c->setContenu($commentaire['contenu']);
            $commentaires[] = $c;
        }
        return $commentaires;
    }

    public function findById($params): Comment
    {
        $stmt = $this->db->prepare("SELECT * FROM commentaire WHERE id_article = :id");
        $stmt->bindValue(':id', $params);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetchAll();
        if (!$arr) {
            throw new PDOException("Could not find id in database");
        }
        $stmt = null;
        $commentaires = [];
        foreach ($arr as $commentaire) {
            $c = new Comment($commentaire['id_user'], $commentaire['id_article']);
            $c->setContenu($commentaire['contenue']);
            $commentaires[] = $c;
        }
        return $commentaires;
    }

    public function remove(Comment $commentaire)
    {
        $stmt = $this->db->prepare("DELETE FROM commentaire WHERE id_commentaire = :id");
        $stmt->bindValue(':id', $commentaire->getIdCommentaire());
        $stmt->execute();
        $stmt = null;
    }
}
