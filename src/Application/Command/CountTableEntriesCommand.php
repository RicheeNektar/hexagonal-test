<?php

namespace App\Application\Command;

use App\Domain\ListTables\TableRequest;
use App\Domain\ListTables\ITablesRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CountTableEntriesCommand extends Command
{
    protected static $defaultName = "countTable";

    public function __construct(
        private ITablesRepository $tablesRepository
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('table', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->tablesRepository->countEntries(new TableRequest($input->getArgument('table')));
        $output->writeln($response->entries());
        return 0;
    }
}