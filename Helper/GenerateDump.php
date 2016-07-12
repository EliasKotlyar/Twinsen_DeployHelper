<?php
namespace Twinsen\DeployHelper\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;

class GenerateDump
{
    const DATABASE_SQLITE_SQL = "/database/sqlite.sql";
    /**
     * @var \Magento\Backup\Model\ResourceModel\Helper
     */
    private $backupHelper;
    /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    private $moduleReader;
    /**
     * @var \Magento\Framework\Filesystem
     */
    private $filesystem;

    public function __construct(\Magento\Backup\Model\ResourceModel\Helper $backupHelper,
                                \Magento\Framework\Module\Dir\Reader $moduleReader,
                                \Magento\Framework\Filesystem $filesystem
    )
    {
        $this->backupHelper = $backupHelper;
        $this->moduleReader = $moduleReader;
        $this->filesystem = $filesystem;
    }

    public function generateDump()
    {

        $tableArray = array("core_config_data", "store", "store_group", "store_website", "theme", "translation");
        $sqlite = new \Zend_Db_Adapter_Pdo_Sqlite(array('dbname' => "staticsettings.db"));
        $filePath = $this->getModuleDir() . self::DATABASE_SQLITE_SQL;
        echo $filePath;
        $content = $this->readFile($filePath);
        echo $content;
        $sqlite->exec($content);



        foreach ($tableArray as $tableName) {
            $sql = $this->backupHelper->getInsertSql($tableName);
            if($sql){
                $sqlite->exec($sql);
            }

        }
    }

    public function getModuleDir()
    {

        return $this->moduleReader->getModuleDir(\Magento\Framework\Module\Dir::MODULE_ETC_DIR, "Twinsen_DeployHelper");
    }

    public function readFile($path)
    {
        return file_get_contents($path);
        /**
        $read = $this->filesystem->getDirectoryRead(DirectoryList::ROOT);
        return $read->read($path);
         */


    }
}