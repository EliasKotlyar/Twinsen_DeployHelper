<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Model;

use Magento\Framework\ObjectManagerInterface;
use Twinsen\DeployHelper\Model\Type\Db\Pdo\SqliteConnectionAdapter;

class ResourceConnectionPlugin
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;
    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private $sqliteConnection;

    public function __construct(
        \Twinsen\DeployHelper\Model\Registry $registry,
        ObjectManagerInterface $objectManager

    )
    {

        $this->registry = $registry;
        $this->objectManager = $objectManager;
    }

    public function aftergetConnectionByName(\Magento\Framework\App\ResourceConnection $connection, $result)
    {

        if ($this->registry->registry('use_sqlite')) {
            if (!$this->sqliteConnection) {
                return $this->createConnection();
            }
            $result = $this->sqliteConnection;
        }
        return $result;
    }

    /**
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected function createConnection()
    {

        $connectionConfig = array('dbname'
        => "staticsettings.db"
        );

        /** @var \Magento\Framework\App\ResourceConnection\ConnectionAdapterInterface $adapterInstance */
        $adapterInstance = $this->objectManager->create(
            SqliteConnectionAdapter::class,
            ['config' => $connectionConfig]
        );


        return $adapterInstance->getConnection($this->objectManager->get(\Magento\Framework\DB\LoggerInterface::class));

    }


}