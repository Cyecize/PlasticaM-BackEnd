<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthToken
 *
 * @ORM\Table(name="auth_tokens")
 * @ORM\Entity(repositoryClass="App\Repository\AuthTokenRepository")
 */
class AuthToken
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="last_access_date", type="datetime")
     */
    private $lastAccessDate;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    public function __construct()
    {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getLastAccessDate(): DateTime
    {
        return $this->lastAccessDate;
    }

    public function setLastAccessDate(DateTime $lastAccessDate): void
    {
        $this->lastAccessDate = $lastAccessDate;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}