<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class GenerateDump
{
    const SAMPLEDB_DIRECTORY = "/database/";
    const SAMPLEDB_FILENAME = "sqlite.sql";
    const DEFAULT_DB_NAME = "staticsettings.db";
    /**
     * @var \Magento\Backup\Model\ResourceModel\Helper
     */
    private $backupHelper;
    /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    private $moduleReader;
    /**
     * @var Filesystem\Directory\ReadFactory
     */
    private $readFactory;
    /**
     * @var Filesystem\Directory\WriteFactory
     */
    private $writeFactory;
    /**
     * @var Filesystem
     */
    private $filesystem;


    public function __construct(\Magento\Backup\Model\ResourceModel\Helper $backupHelper,
                                \Magento\Framework\Module\Dir\Reader $moduleReader,
                                Filesystem\Directory\ReadFactory $readFactory,
                                Filesystem\Directory\WriteFactory $writeFactory,
                                \Magento\Framework\Filesystem $filesystem
    )
    {
        $this->backupHelper = $backupHelper;
        $this->moduleReader = $moduleReader;

        $this->readFactory = $readFactory;
        $this->writeFactory = $writeFactory;
        $this->filesystem = $filesystem;
    }

    public function generateDump($dbName = self::DEFAULT_DB_NAME)
    {
        $rootDir = $this->filesystem->getDirectoryRead(DirectoryList::ROOT);
        if ($rootDir->isExist($dbName)) {
            $this->deleteFile($rootDir->getAbsolutePath(), $dbName);
        }

        $tableArray = array("core_config_data", "store", "store_group", "store_website", "theme", "translation", "flag");
        $sqlite = new \Zend_Db_Adapter_Pdo_Sqlite(array('dbname' => $rootDir->getAbsolutePath() . "/" . $dbName));
        $filePath = $this->getModuleDir() . self::SAMPLEDB_DIRECTORY;
        $content = $this->readFile($filePath, self::SAMPLEDB_FILENAME);

        $sqlite->exec($content);


        foreach ($tableArray as $tableName) {
            $sql = $this->backupHelper->getInsertSql($tableName);
            if ($sql) {
                $sqlite->exec($sql);
            }

        }
    }

    /**
     * Deletes the File
     * @param $path
     * @param $fileName
     * @return mixed
     */
    public function deleteFile($path, $fileName)
    {
        $write = $this->writeFactory->create($path);
        return $write->delete($fileName);
    }

    public function getModuleDir()
    {

        return $this->moduleReader->getModuleDir(\Magento\Framework\Module\Dir::MODULE_ETC_DIR, "Twinsen_DeployHelper");
    }

    /**
     * Reads a File to an String
     * @param $path
     * @param $fileName
     * @return string
     */
    public function readFile($path, $fileName)
    {
        $read = $this->readFactory->create($path);
        return $read->readFile($fileName);
    }
}
