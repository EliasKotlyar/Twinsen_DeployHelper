<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Console\Command;

use Magento\Framework\App\ObjectManagerFactory;
use Magento\Framework\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Class AbstractCommand
 * @package Twinsen\DeployHelper\Console\Command
 */
class AbstractCommand extends Command
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;


    /**
     * Constructor
     *
     * @param ObjectManagerFactory $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;

        parent::__construct();
    }

}