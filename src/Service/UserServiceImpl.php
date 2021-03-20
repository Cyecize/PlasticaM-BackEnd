<?php

namespace App\Service;

use App\Constants\Roles;
use App\Entity\Role;
use App\Entity\User;
use App\Exception\ApiException;
use App\Repository\UserRepository;
use App\Utils\ModelMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserServiceImpl implements UserService
{
    private const CANNOT_ALTER_ADMIN = "Cannot remove admin privileges!";
    private const USER_HAS_THAT_ROLE = "User already has that role!";
    private const USER_DOES_NOT_HAVE_ROLE = "User doesn't have that role!";
    private const CANNOT_ALTER_GOD = "Cannot alter god account!";

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserRepository|ObjectRepository
     */
    private $userRepo;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var ModelMapper
     */
    private $modelMapper;


    public function __construct(EntityManagerInterface $entityManager,
                                UserPasswordEncoderInterface $passwordEncoder,
                                ModelMapper $modelMapper)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepo = $entityManager->getRepository(User::class);
        $this->modelMapper = $modelMapper;
    }

    function save(User $user): void
    {
        $this->entityManager->merge($user);
        $this->entityManager->flush();
    }

    function removeRole(User $user, Role $role): void
    {
        if ($user->hasRole(Roles::ROLE_GOD))
            throw new ApiException(self::CANNOT_ALTER_GOD);
        if (!$user->hasRole($role->getRole()))
            throw new ApiException(self::USER_DOES_NOT_HAVE_ROLE);
        $user->removeRole($role);
        $this->save($user);
    }

    function addRole(User $user, Role $role): void
    {
        if ($user->hasRole($role->getRole()))
            throw new ApiException(self::USER_HAS_THAT_ROLE);
        $user->addRole($role);
        $this->save($user);
    }

//    function changePassword(User $user, ChangePasswordBindingModel $bindingModel, bool $verify = true): void
//    {
//        if ($verify && !password_verify($bindingModel->getOldPassword(), $user->getPassword()))
//            throw new ApiException("invalidPassword");
//        $user->setPassword($this->passwordEncoder->encodePassword($user, $bindingModel->getNewPassword()));
//        $this->entityManager->merge($user);
//        $this->entityManager->flush();
//    }

//    function removeAccount(User $user): void
//    {
//        if($user->hasRole(Roles::ROLE_GOD))
//            throw new ApiException(self::CANNOT_ALTER_GOD);
//        $this->entityManager->remove($user);
//        $this->entityManager->flush();
//    }

    function findOneById(int $id): ?User
    {
        return $this->userRepo->find($id);
    }

    function findOneByUsernameOrEmail(string $username): ?User
    {
        return $this->userRepo->findByUsernameOrEmail($username);
    }

    function findAll(): array
    {
        return $this->userRepo->findAll();
    }

    function findByRole(string $role): array
    {
        return $this->userRepo->findByRoleName($role);
    }

    public function loadUserByUsername($username)
    {
        $user = $this->findOneByUsernameOrEmail($username);

        if ($user == null) {
            throw new UsernameNotFoundException(sprintf("User with username or email '%s' does not exist", $username));
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException('No need to refresh user on stateless security.');
    }

    public function supportsClass($class)
    {
        return User::class == $class
            || is_subclass_of(User::class, $class)
            || str_contains($class, User::class);
    }
}