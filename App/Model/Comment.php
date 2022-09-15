<?php

namespace App\Model;

use DateTime;

class Comment
{
    private int $id_commentaire;
    private string $contenu;
    private DateTime $date_created;
    private int $id_user;
    private int $id_article;

    public function __construct(int $id_user, int $id_article)
    {
        $this->id_user = $id_user;
        $this->id_article = $id_article;
        $this->date_created = new DateTime();
    }

    /**
     * @return string
     */
    public function getContenu(): string
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return int
     */
    public function getIdArticle(): int
    {
        return $this->id_article;
    }

    /**
     * @return int
     */
    public function getIdCommentaire(): int
    {
        return $this->id_commentaire;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->date_created->format('Y-m-d');
    }


}