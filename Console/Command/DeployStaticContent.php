<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Console\Command;

use Magento\Deploy\Console\Command\DeployStaticContentCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeployStaticContent
 *
 * @package Twinsen\DeployHelper\Console\Command
 * Deploys Static Content without using the Database
 */
class DeployStaticContent extends AbstractCommand
{

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */

    public function execute(InputInterface $input, OutputInterface $output)
    {


        /** @var \Twinsen\DeployHelper\Model\Registry $registry */
        $registry = $this->objectManager->get('\Twinsen\DeployHelper\Model\Registry');
        $registry->register('use_sqlite', '1');

        $command = $this->getApplication()->find('setup:static-content:deploy');

        $returnCode = $command->run($input, $output);
        return $returnCode;


    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('deployhelper:deploy')
            ->setDescription('Deploys Static Content')
            ->setDefinition(
                [
                    new InputOption(
                        DeployStaticContentCommand::DRY_RUN_OPTION,
                        '-d',
                        InputOption::VALUE_NONE,
                        'If specified, then no files will be actually deployed.'
                    ),
                    new InputArgument(
                        DeployStaticContentCommand::LANGUAGE_OPTION,
                        InputArgument::IS_ARRAY,
                        'List of languages you want the tool populate files for.',
                        ['en_US']
                    ),
                ]
            );
        parent::configure();
    }
}
