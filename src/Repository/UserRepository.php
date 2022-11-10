<?php

namespace App\Repository;

use App\Connection\ConnectionFactory;
use App\Entity\User;
use App\Exception\ConnectionException;
use PDO;

class UserRepository
{
//    private string $SQL_SELECT_ALL = 'SELECT * FROM user';
//    private string $SQL_SELECT_BY_EMAIL = 'SELECT * FROM user WHERE email = :email';
//    private string $SQL_INSERT = 'INSERT INTO user (email, name, gender, status) VALUE (:email, :name, :gender, :status)';
//    private string $SQL_UPDATE = 'UPDATE user SET name = :name, gender = :gender, status = :status WHERE email = :email';
//    private string $SQL_DELETE = 'DELETE FROM user WHERE email = :email';

    private ConnectionFactory $connectionFactory;

    public function __construct()
    {
        $this->connectionFactory = new ConnectionFactory();
    }

//    public function findAll(): array
//    {
//
//    }
//
//    public function findByEmail(string $email): User
//    {
//
//    }
//
//    public function addUser(User $toAdd): User
//    {
//
//    }
//
//    public function updateUser(User $toUpdate): User
//    {
//
//    }
//
//    public function deleteUser(string $email): void
//    {
//
//    }
}
