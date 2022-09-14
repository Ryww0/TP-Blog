<?php

namespace App\Repository;

use App\Model\User;

interface IUserRepository
{
    public function add(User $user): User;

    public function fetchAll() : array;

    public function findById($params): User;

    public function update(User $user);

    public function remove(User $user);

}
