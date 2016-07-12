----
-- phpLiteAdmin database dump (https://bitbucket.org/phpliteadmin/public)
-- phpLiteAdmin version: 1.9.6
-- Exported: 1:27pm on July 10, 2016 (PDT)
-- database file: ./deploy.sqlite
----
BEGIN TRANSACTION;

----
-- Table structure for core_config_data
----
CREATE TABLE `core_config_data` (
  `config_id` int(10)  NOT NULL ,
  `scope` varchar(8) NOT NULL DEFAULT 'default' ,
  `scope_id` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT 'general' ,
  `value` text 
);

----
-- Table structure for store_website
----
CREATE TABLE `store_website` (
  `website_id` smallint(5)  NOT NULL ,
  `code` varchar(32) DEFAULT NULL ,
  `name` varchar(64) DEFAULT NULL ,
  `sort_order` smallint(5)  NOT NULL DEFAULT '0' ,
  `default_group_id` smallint(5)  NOT NULL DEFAULT '0' ,
  `is_default` smallint(5) DEFAULT '0' 
);

----
-- Table structure for store
----
CREATE TABLE `store` (
  `store_id` smallint(5)  NOT NULL ,
  `code` varchar(32) DEFAULT NULL ,
  `website_id` smallint(5)  NOT NULL DEFAULT '0' ,
  `group_id` smallint(5)  NOT NULL DEFAULT '0' ,
  `name` varchar(255) NOT NULL ,
  `sort_order` smallint(5)  NOT NULL DEFAULT '0' ,
  `is_active` smallint(5)  NOT NULL DEFAULT '0' 
);

----
-- Table structure for store_group
----
CREATE TABLE `store_group` (
  `group_id` smallint(5) NOT NULL ,
  `website_id` smallint(5) NOT NULL DEFAULT '0' ,
  `name` varchar(255) NOT NULL ,
  `root_category_id` int(10)  NOT NULL DEFAULT '0' ,
  `default_store_id` smallint(5)  NOT NULL DEFAULT '0' 
);

----
-- Table structure for translation
----
CREATE TABLE `translation` (
  `key_id` int(10) NOT NULL ,
  `string` varchar(255) NOT NULL DEFAULT 'Translate String' ,
  `store_id` smallint(5) NOT NULL DEFAULT '0' ,
  `translate` varchar(255) DEFAULT NULL ,
  `locale` varchar(20) NOT NULL DEFAULT 'en_US' ,
  `crc_string` bigint(20) NOT NULL DEFAULT '1591228201' 
);

----
-- Table structure for theme
----
CREATE TABLE `theme` (
  `theme_id` int(10)  NOT NULL,
  `parent_id` int(11) DEFAULT NULL ,
  `theme_path` varchar(255) DEFAULT NULL ,
  `theme_title` varchar(255) NOT NULL ,
  `preview_image` varchar(255) DEFAULT NULL ,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0' ,
  `area` varchar(255) NOT NULL ,
  `type` smallint(6) NOT NULL ,
  `code` text 
);
COMMIT;
