<?php

declare(strict_types=1);

namespace App\Core\Web\Controllers;

use App\ORM\DataMapper\Entity\User;
use App\ORM\DataMapper\Repositories\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\NotSupported;
use Exception;

class UserController
{
    /**
     * @var UserRepository
     */
    protected EntityRepository $userRepository;

    /**
     * @throws NotSupported
     */
    public function __construct(protected EntityManager $entityManager)
    {
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    /**
     * @throws Exception
     */
    public function indexAction(string $id): string
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);

        if (true === is_null($user)) {
            throw new Exception('Record not found!');
        }

        return $user->getId() . '. ' . $user->getName() . ' - ' . $user->getEmail() . ' - ' . $user->getStatus();
    }

    public function allUsersAction(): string
    {
        $users  = $this->userRepository->findAll();
        $result = '';

        foreach ($users as $user) {
            $result .= $user->getId() . '. ' . $user->getName() . ' - ' .
                $user->getEmail() . ' - ' . $user->getStatus() . "<br>";
        }

        return $result;
    }
}