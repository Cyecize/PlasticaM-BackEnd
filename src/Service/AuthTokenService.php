<?php

namespace App\Service;

use App\Entity\AuthToken;
use App\Entity\User;

interface AuthTokenService
{

    public function update(AuthToken $token): void;

    public function remove(AuthToken $token): void;

    public function removeByUser(User $user): void;

    public function isExpired(AuthToken $token): bool;

    public function create(User $user): AuthToken;

    public function findById(string $id): ?AuthToken;

}