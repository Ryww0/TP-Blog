<?php

namespace App\Service;

use PDO;
use PDOException;

class Database
{
    protected ?PDO $db = null;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=" . (DB_HOST) . ";dbname=" . (DB_NAME) . "", DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function close(): void
    {
        $this->db = null;
    }
}