<?php
namespace Twinsen\DeployHelper\Console\Command;

use Magento\Framework\App\ObjectManagerFactory;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\ObjectManagerInterface;
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