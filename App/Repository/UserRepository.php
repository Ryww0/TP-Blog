<?php


namespace App\Repository;

use App\Service\Database;
use PDO;
use PDOException;

class UserRepository extends Database implements IUserRepository
{
    public function add(User $user): User
    {
        $stmt = $this->db->prepare("INSERT INTO user (pseudo, email, password, status) VALUES (:pseudo, :email, :password, :status)");
        $stmt->bindValue(':pseudo', $user->getPseudo());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT ));
        $stmt->bindValue(':status', $user->getStatus());
        $stmt->execute();
        $stmt = null;
    }

    public function fetchAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM user ORDER BY nom ASC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetchAll();
        if (!$arr) {
            throw new PDOException("Could not find user in database");
        }
        $stmt = null;
        $users = [];
        foreach ($arr as $user) {
            $u = new User();
            $u->setId($user['id']);
            $u->setPseudo($user['pseudo']);
            $u->setEmail($user['pseudo']);
            $u->setPassword($user['pseudo']);
            $u->setStatus($user['status']);
            $users[] = $u;
        }
        return $users;
    }

    public function findById($params): User
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindValue(':id', $params);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $arr = $stmt->fetch();
        if (!$arr) {
            throw new PDOException("Could not find id in database");
        }
        $stmt = null;
        $user = new User();
        $user->setId($arr['id']);
        $user->setPseudo($arr['pseudo']);
        $user->setEmail($arr['pseudo']);
        $user->setPassword($arr['pseudo']);
        $user->setStatus($arr['status']);
        return $user;
    }

    public function update(User $user)
    {
        $stmt = $this->db->prepare("UPDATE user 
                                          SET pseudo = :pseudo 
                                          email = :email
                                          password = :password
                                          WHERE id = :id");
        $stmt->bindValue(':pseudo', $user->getPseudo());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
        $stmt = null;
    }

    public function remove(User $user)
    {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
        $stmt = null;
    }
}