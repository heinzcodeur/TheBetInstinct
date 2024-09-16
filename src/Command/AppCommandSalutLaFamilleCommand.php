<?php

namespace App\Command;

use App\Entity\Pays;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:salut',
    description: 'Donne un salut à un pays aléatoire!',
)]
class AppCommandSalutLaFamilleCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        // Vous pouvez ajouter des arguments ou des options ici si nécessaire
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Récupérer aléatoirement une entité Pays
        $paysRepository = $this->entityManager->getRepository(Pays::class);
        $pays = $paysRepository->findAll();

        if (empty($pays)) {
            $io->error('Aucun pays trouvé dans la base de données.');
            return Command::FAILURE;
        }

        // Sélectionner un pays aléatoirement
        $paysAleatoire = $pays[array_rand($pays)];
        $bad =  ["Nederland", "France", "Allemagne", "Belgique", "Slovenie", "Slovaquie"];

        // Afficher les propriétés name et shortcut
        in_array($paysAleatoire->getName(), $bad) ? ($io->error(sprintf('Salut la famille %s (%s)!', $paysAleatoire->getName(), $paysAleatoire->getShortcut()))) : ($io->success(sprintf('Salut la famille %s (%s)!', $paysAleatoire->getName(), $paysAleatoire->getShortcut())));


        // $io->success(
        //     in_array($paysAleatoire->getName(), ["Nederland", "France", "Allemagne"], true)
        //         ? $io->error(sprintf('Salut la famille %s (%s)!', $paysAleatoire->getName(), $paysAleatoire->getShortcut()))
        //         : $io->success(sprintf('Salut la famille %s (%s)!', $paysAleatoire->getName(), $paysAleatoire->getShortcut()))
        // );

        return Command::SUCCESS;
    }
}
