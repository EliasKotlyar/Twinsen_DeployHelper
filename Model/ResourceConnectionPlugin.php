<?php
namespace Twinsen\DeployHelper\Model;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\EmailNotConfirmedException;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Webapi\Exception;
use Twinsen\DeployHelper\Model\Type\Db\Pdo\ProxyConnectionAdapter;

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

    public function __construct(
        \Magento\Framework\Registry $registry,
        ObjectManagerInterface $objectManager

    )
    {

        $this->registry = $registry;
        $this->objectManager = $objectManager;
    }

    public function aftergetConnectionByName(\Magento\Framework\App\ResourceConnection $connection, $result)
    {
        //throw new Exception();
        return $this->createConnection();

        if ($this->registry->registry('use_sqlite')) {
            //die("getting connection");

        }
        return $result;
    }

    /**
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected function createConnection()
    {
        $connectionConfig = array();
        /** @var \Magento\Framework\App\ResourceConnection\ConnectionAdapterInterface $adapterInstance */
        $adapterInstance = $this->objectManager->create(
            ProxyConnectionAdapter::class,
            ['config' => $connectionConfig]
        );


        return $adapterInstance->getConnection($this->objectManager->get(\Magento\Framework\DB\LoggerInterface::class));

    }


}