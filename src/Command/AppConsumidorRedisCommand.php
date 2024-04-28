<?php

namespace App\Command;

use Predis\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppConsumidorRedisCommand extends Command
{
    private Client $predisClient;
    private string $canal;

    protected static $defaultName = 'app.consumidor-redis';
    protected static $defaultDescription = 'Consumidor de mensajes publicados en un canal';

    public function __construct(Client $predisClient, string $canal)
    {
        $this->predisClient = $predisClient;
        $this->canal = $canal;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->predisClient->executeRaw(['SUBSCRIBE', $this->canal]);

        while (true) {
            $response = $this->predisClient->pubSubLoop()->current();

            if ($response->kind === 'message') {
                echo "Mensaje recibido en el canal {$response->channel}: {$response->payload}\n";
            }
        }

        return Command::SUCCESS;
    }
}
