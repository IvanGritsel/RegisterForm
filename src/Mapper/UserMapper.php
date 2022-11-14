<?php

namespace App\Mapper;

use App\Entity\User;

class UserMapper
{
    public static function toEntity(array $arrayEntity): User
    {
        $user = new User();
        $user->setId($arrayEntity['id'] ?? 0);
        $user->setEmail($arrayEntity['email']);
        $user->setFirstName($arrayEntity['firstName'] ?? $arrayEntity['first_name']);
        $user->setLastName($arrayEntity['lastName'] ?? $arrayEntity['last_name']);
        $user->setPassword($arrayEntity['password']);
        $user->setCreatedDate($arrayEntity['created_date'] ?? '');

        return $user;
    }
}
