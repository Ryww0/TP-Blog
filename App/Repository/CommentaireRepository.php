<?php

namespace App\Repository;

use PDO;
use PDOException;
use App\Service\Database;
use App\Model\Comment;

class CommentaireRepository extends Database implements ICommentaireRepository
{
    public function add(Comment $commentaire) : void
    {
        $stmt = $this->db->prepare("INSERT INTO commentaire (contenue, date_creation, id_user, id_article)
                                          VALUES (:contenue, :date_creation, :id_user, :id_article)");
        $stmt->bindValue(':contenue', $commentaire->getContenu());
        $stmt->bindValue(':date_creation', $commentaire->getDateCreated());
        $stmt->bindValue(':id_user', $commentaire->getIdUser());
        $stmt->bindValue(':id_article', $commentaire->getIdArticle());
        $stmt->execute();
        $stmt = null;
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

    public function fecthAllByIdArticle($params): array
    {
        $stmt = $this->db->prepare("SELECT * FROM commentaire WHERE id_article = :id_article");
        $stmt->bindValue(':id_article', $params);
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
