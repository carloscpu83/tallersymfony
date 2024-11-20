<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ComandoBasicoCommand extends Command
{
    protected static $defaultName = 'app.comando-basico';
    protected static $defaultDescription = 'Comando de pruebas sobre comandos de consola';

    protected function configure(): void
    {
        $this
            ->setDescription('Comando basico de pruebas')
            ->setHelp('Comando basico en el que se van a probar funcionalidades de los comandos de consola')
            ->addArgument('nombre', InputArgument::REQUIRED, 'Nombre de la persona que ejecuta el comando')
            ->addArgument('apellido', InputArgument::REQUIRED, 'Apellido de la persona que ejecuta el comando')
            ->addArgument('numeros', InputArgument::IS_ARRAY|InputArgument::REQUIRED, 'Numeros de la suerte de la persona que ejecuta el comando')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $nombre = $input->getArgument('nombre');
        $apellido = $input->getArgument('apellido');

        if ($nombre) {
            $io->note(sprintf('Argumentos pasados por paramtro: %s, %s', $nombre, $apellido));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
