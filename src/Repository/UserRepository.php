<?php

namespace App\Repository;

use App\Connection\ConnectionFactory;
use App\Entity\User;
use App\Mapper\UserMapper;
use Exception;
use PDO;

class UserRepository
{
    private string $SQL_FIND_BY_EMAIL = 'SELECT * FROM users WHERE email=:email';
    private string $SQL_INSERT = 'INSERT INTO users (email, first_name, last_name, password) VALUE (:email, :firstName, :lastName, :password)';

    private ConnectionFactory $connectionFactory;

    public function __construct()
    {
        $this->connectionFactory = new ConnectionFactory();
    }

    /**
     * @throws Exception
     */
    public function findUserByEmail(string $email): User|bool
    {
        try {
            $connection = $this->connectionFactory->getConnection();
            $statement = $connection->prepare($this->SQL_FIND_BY_EMAIL);

            $statement->bindParam(':email', $email);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();

            return !empty($result) ? UserMapper::toEntity($result[0]) : false;
        } catch (Exception $e) {
            throw new Exception('Cant execute request', 503, $e);
        }
    }

    /**
     * @throws Exception
     */
    public function addUser(User $toAdd): User
    {
        try {
            $connection = $this->connectionFactory->getConnection();
            $statement = $connection->prepare($this->SQL_INSERT);

            $email = $toAdd->getEmail();
            $firstName = $toAdd->getFirstName();
            $lastName = $toAdd->getLastName();
            $password = $toAdd->getPassword();

            $statement->bindParam(':email', $email);
            $statement->bindParam(':firstName', $firstName);
            $statement->bindParam(':lastName', $lastName);
            $statement->bindParam(':password', $password);

            $statement->execute();
            $toAdd->setId($connection->lastInsertId());

            $connection = null;

            return $toAdd;
        } catch (Exception $e) {
            throw new Exception('Cant execute request', 503, $e);
        }
    }
}
