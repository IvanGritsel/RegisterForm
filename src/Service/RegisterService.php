<?php

namespace App\Service;

use App\Mapper\UserMapper;
use App\Repository\UserRepository;
use Exception;

class RegisterService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @throws Exception
     */
    public function register(string $userJson): string
    {
        $userArray = json_decode($userJson, true);
        if ($this->userRepository->findUserByEmail($userArray['email'])) {
            throw new Exception('User already exists', 400);
        }
        $user = UserMapper::toEntity($userArray);
        $user = $this->userRepository->addUser($user);
        $user->setPassword('');
        $user->setCreatedDate(date('Y-m-d'));

        return json_encode($user);
    }
}
