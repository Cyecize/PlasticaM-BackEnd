<?php

namespace App\Service;

use App\Entity\Log;
use App\Repository\LogRepository;
use App\Utils\DateUtils;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class LogServiceImpl implements LogService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManger;

    /**
     * @var LogRepository|ObjectRepository
     */
    private $logRepo;

    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManger = $entityManger;
        $this->logRepo = $entityManger->getRepository(Log::class);
    }


    public function log(string $location, string $message): void
    {
        $log = new Log();
        $log->setLocation($location);
        $log->setMessage($message);
        $log->setDate(DateUtils::getNow());
        $this->entityManger->persist($log);
        $this->entityManger->flush();
    }
}