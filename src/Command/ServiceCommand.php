<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:service',
    description: 'Add a short description for your command',
)]
class ServiceCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('service', InputArgument::OPTIONAL, 'Service name')
            ->addOption('myOption', '-m', InputOption::VALUE_NONE, 'mY Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $serviceName = $input->getArgument('service');

        if( is_null($serviceName)){
            
        }

        // dd($input->getOptions(), $input->getArguments());

        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
