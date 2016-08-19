<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Model\Type\Db;

use Twinsen\DeployHelper\Model\Type\Db\Select;
use Magento\Framework\DB\Select\SelectRenderer;
use Magento\Framework\DB\Select\SelectRendererFactory;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Stdlib\StringUtils;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\DB\LoggerInterface;

/**
 * Class SelectFactory
 */
class SelectFactory
{
    /**
     * @var SelectRendererFactory
     */
    protected $selectRendererFactory;

    /**
     * @var array
     */
    protected $parts;
    /**
     * @var \Magento\Framework\DB\Adapter\Pdo\Mysql
     */
    private $mysqlAdapter;
    /**
     * @var StringUtils
     */
    private $stringUtils;
    /**
     * @var DateTime
     */
    private $dateTime;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\DB\SelectFactory
     */
    private $selectFactory;

    /**
     * @param SelectRendererFactory $selectRendererFactory
     * @param array $parts
     */
    public function __construct(
        SelectRendererFactory $selectRendererFactory,
        StringUtils $stringUtils,
        DateTime $dateTime,
        LoggerInterface $logger,
        \Magento\Framework\DB\SelectFactory $selectFactory,
        $parts = []
    ) {
        $this->selectRendererFactory = $selectRendererFactory;
        $this->parts = $parts;
        $this->stringUtils = $stringUtils;
        $this->dateTime = $dateTime;
        $this->logger = $logger;
        $this->selectFactory = $selectFactory;
    }

    /**
     * @param AdapterInterface $adapter
     * @return \Magento\Framework\DB\Select
     */
    public function create(AdapterInterface $adapter)
    {
        // create select renderer on-the-fly to prevent circular dependency issues
        $selectRenderer = $this->selectRendererFactory->create();

        // Hack for getting the PDO-Mysql for the Parameter in PDO_MYSQL
        $config = array(
            "dbname"=>"test",
            "username"=>"test",
            "password"=>"test",
        );
        $mysqlAdapter = new \Magento\Framework\DB\Adapter\Pdo\Mysql($this->stringUtils,$this->dateTime,$this->logger,$this->selectFactory,$config);
        // Hack End...

        return new Select($adapter, $mysqlAdapter, $selectRenderer, $this->parts);
    }
}
