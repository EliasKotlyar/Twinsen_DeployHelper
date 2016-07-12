<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

// @codingStandardsIgnoreFile

namespace Twinsen\DeployHelper\Model\Type\Db\Pdo;
use Magento\Framework\App\ResourceConnection\ConnectionAdapterInterface;
use Magento\Framework\DB;
//use Magento\Framework\DB\SelectFactory;
use Twinsen\DeployHelper\Model\Type\Db\SelectFactory;
use Magento\Framework\Stdlib;

class ProxyConnectionAdapter extends \Magento\Framework\Model\ResourceModel\Type\Db implements ConnectionAdapterInterface
{
    /**
     * @var Stdlib\StringUtils
     */
    protected $string;

    /**
     * @var Stdlib\DateTime
     */
    protected $dateTime;

    /**
     * @var array
     */
    protected $connectionConfig;

    /**
     * @var
     */
    protected $selectFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param Stdlib\StringUtils $string
     * @param Stdlib\DateTime $dateTime
     * @param SelectFactory $selectFactory
     * @param array $config
     */
    public function __construct(
        Stdlib\StringUtils $string,
        Stdlib\DateTime $dateTime,
        SelectFactory $selectFactory,
        \Magento\Framework\Registry $registry,
        array $config
    ) {
        $this->string = $string;
        $this->dateTime = $dateTime;
        $this->selectFactory = $selectFactory;
        $this->connectionConfig = $this->getValidConfig($config);
        $this->registry = $registry;
        parent::__construct();

    }

    /**
     * {@inheritdoc}
     */
    public function getConnection(DB\LoggerInterface $logger)
    {
        $connection = $this->getDbConnectionInstance($logger);


        $profiler = $connection->getProfiler();
        if ($profiler instanceof DB\Profiler) {
            $profiler->setType($this->connectionConfig['type']);
            $profiler->setHost($this->connectionConfig['host']);
        }

        return $connection;
    }

    /**
     * Create and return DB connection object instance
     *
     * @param DB\LoggerInterface $logger
     * @return \Magento\Framework\DB\Adapter\Pdo\Mysql
     */
    protected function getDbConnectionInstance(DB\LoggerInterface $logger)
    {
        $className = $this->getDbConnectionClassName();
        return new $className($this->string, $this->dateTime, $logger, $this->selectFactory, $this->connectionConfig);
    }

    /**
     * Retrieve DB connection class name
     *
     * @return string
     */
    protected function getDbConnectionClassName()
    {
        // Its not a Bug,its a feature. i use it for getting into the MYSQL-Class
        if(1==0){
            return DB\Adapter\Pdo\Mysql::class;
        }

        return \Twinsen\DeployHelper\Model\Type\Db\Pdo\Sqlite::class;
    }

    /**
     * Validates the config and adds default options, if any is missing
     *
     * @param array $config
     * @return array
     */
    private function getValidConfig(array $config)
    {
       

        return $config;
    }
}
