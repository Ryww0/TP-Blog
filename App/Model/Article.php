<?php

namespace App\Model;

use DateTime;

class Article
{
    private int $id_article;
    private string $titre;
    private string $image;
    private string $contenu;
    private DateTime $date_created;
    private string $date_updated;
    private int $id_user;

    public function __construct(string $titre, string $image, int $id_user)
    {
        $this->titre = $titre;
        $this->image = $image;
        $this->id_user = $id_user;
        $this->date_creation = new DateTime();
    }

    /**
     * @return int
     */
    public function getIdArticle(): int
    {
        return $this->id_article;
    }

    public function setId($article)
    {
        $this->id_article = $article;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
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
     * @return DateTime|false|string
     */
    public function getDateCreated()
    {
        return $this->date_created->format('Y-m-d');

    }

    /**
     * @return string
     */
    public function getDateUpdated(): string
    {
        return $this->date_updated;
    }

    /**
     * @param string $date_updated
     */
    public function setDateUpdated(string $date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

}