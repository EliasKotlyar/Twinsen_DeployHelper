<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateSqliteDB
 * @package Twinsen\DeployHelper\Console\Command
 * Generates a Sqlite Database for usage
 */
class GenerateSqliteDB extends AbstractCommand
{


    /**
     *
     */
    protected function configure()
    {
        $this->setName('deployhelper:generatedb')->setDescription('Generates a Database for Sqlite');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Twinsen\DeployHelper\Helper\GenerateDump $dumpHelper */
        $dumpHelper = $this->objectManager->get('Twinsen\DeployHelper\Helper\GenerateDump');
        $dumpHelper->generateDump();


    }


}