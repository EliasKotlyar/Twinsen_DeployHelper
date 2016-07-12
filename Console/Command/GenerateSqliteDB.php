<?php
namespace Twinsen\DeployHelper\Console\Command;


use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;

/**
 * Class GenerateSqliteDB
 * @package Twinsen\DeployHelper\Console\Command
 * Generates a Sqlite Database for usage
 */
class GenerateSqliteDB extends AbstractCommand
{




    protected function configure()
    {
        $this->setName('twinsen:deployhelper:generatedb')->setDescription('Generates a Database for Sqlite');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Twinsen\DeployHelper\Helper\GenerateDump $dumpHelper     */
        $dumpHelper = $this->objectManager->get('Twinsen\DeployHelper\Helper\GenerateDump');
        $dumpHelper->generateDump();


    }



}