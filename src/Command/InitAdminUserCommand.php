<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'InitAdminUser',
    description: 'Add a short description for your command',
)]
class InitAdminUserCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('password', InputArgument::REQUIRED, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();

        $password = $input->getArgument('password');
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $password
            )
        );


        $user->setEmail('wrextuus@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return Command::SUCCESS;
    }
}
