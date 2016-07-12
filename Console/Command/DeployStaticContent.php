<?php
namespace Twinsen\DeployHelper\Console\Command;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeployStaticContent
 * @package Twinsen\DeployHelper\Console\Command
 * Deploys Static Content without using the Database
 */
class DeployStaticContent extends AbstractCommand
{


    public function execute(InputInterface $input, OutputInterface $output)
    {
        

        /** @var \Magento\Framework\Registry $registry */
        $registry = $this->objectManager->get('\Magento\Framework\Registry');
        $registry->register('use_sqlite', '1');


        $command = $this->getApplication()->find('setup:static-content:deploy');

        $arguments = array();

        $greetInput = new ArrayInput($arguments);
        $returnCode = $command->run($greetInput, $output);


    }

    protected function configure()
    {
        $this->setName('deployhelper:deploy')->setDescription('Deploys Static Content');
    }

}