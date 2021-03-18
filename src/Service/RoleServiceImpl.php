<?php
/**
 * Created by IntelliJ IDEA.
 * User: tyaki
 * Date: 10/8/2018
 * Time: 12:48 PM
 */

namespace App\Service;

use App\Constants\Roles;
use App\Entity\Role;
use App\Exception\ApiException;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class RoleServiceImpl implements RoleService
{
    private const ROLE_NAME_TAKEN = "Role with that name already exists!";

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RoleRepository|ObjectRepository
     */
    private $roleRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->roleRepo = $entityManager->getRepository(Role::class);
    }

    function createRolesIfNotExist(): void
    {
        foreach (Roles::ALL as $role) {
            if ($this->findByRoleName($role) == null) {
                $this->createRole($role);
            }
        }
    }

    function createRole(string $roleName): ?Role
    {
        if ($this->findByRoleName($roleName) != null)
            throw new ApiException(self::ROLE_NAME_TAKEN);

        $role = new Role($roleName);
        $this->entityManager->persist($role);
        $this->entityManager->flush();

        return $role;
    }

    function findById(int $id): ?Role
    {
        return $this->roleRepo->findOneBy(array('id' => $id));
    }

    function findByRoleName(string $roleName): ?Role
    {
        return $this->roleRepo->findOneBy(array('role' => $roleName));
    }

    function findAll(): array
    {
        return $this->roleRepo->findAll();
    }
}