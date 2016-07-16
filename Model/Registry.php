<?php
/**
 * *
 *  * Copyright © Elias Kotlyar - All rights reserved.
 *  * See LICENSE.md bundled with this module for license details.
 *
 */

namespace Twinsen\DeployHelper\Model;
/**
 * Own Registry "implementation" which uses Static Variables to keep the Value of the Original Registry Object as Static
 * Class Registry
 * @package Twinsen\DeployHelper\Model
 */
class Registry
{

    /**
     * @var \Magento\Framework\Registry
     */
    static $registry;

    public function __construct(\Magento\Framework\Registry $registry)
    {
        if(!self::$registry){
            self::$registry = $registry;
        }
    }

    /**
     * Retrieve a value from registry by a key
     *
     * @param string $key
     * @return mixed
     */
    public function registry($key)
    {
      return self::$registry->registry($key);
    }

    /**
     * Register a new variable
     *
     * @param string $key
     * @param mixed $value
     * @param bool $graceful
     * @return void
     * @throws \RuntimeException
     */
    public function register($key, $value, $graceful = false)
    {
        self::$registry->register($key, $value, $graceful);
    }

    /**
     * Unregister a variable from register by key
     *
     * @param string $key
     * @return void
     */
    public function unregister($key)
    {
        self::$registry->unregister($key);
    }



}
