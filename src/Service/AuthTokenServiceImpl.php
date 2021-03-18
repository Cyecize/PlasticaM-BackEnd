<?php

namespace App\Service;

use App\Constants\Config;
use App\Entity\AuthToken;
use App\Entity\User;
use App\Utils\DateUtils;
use Doctrine\ORM\EntityManagerInterface;

class AuthTokenServiceImpl implements AuthTokenService
{
    private $repository;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(AuthToken::class);
        $this->entityManager = $entityManager;
    }

    public function update(AuthToken $token): void
    {
        $token->setLastAccessDate(DateUtils::getNow());
        $this->entityManager->flush();
    }

    public function remove(AuthToken $token): void
    {
        $this->entityManager->remove($token);
        $this->entityManager->flush();
    }

    public function removeByUser(User $user): void
    {
        $this->repository->deleteByUserId($user->getId());
    }

    public function isExpired(AuthToken $token): bool
    {
        $now = DateUtils::getNow();
        $lastAccessTime = $token->getLastAccessDate();

        return abs(DateUtils::diff($now, $lastAccessTime)->i) > $_ENV[Config::ENV_TOKEN_EXPIRE_MINUTES];
    }

    public function create(User $user): AuthToken
    {
        $token = new AuthToken();

        $token->setLastAccessDate(DateUtils::getNow());
        $token->setUser($user);

        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }

    public function findById(string $id): ?AuthToken
    {
        return $this->repository->find($id);
    }
}