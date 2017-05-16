<?php

$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE {$this->getTable('straaslive')} (
  `live_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `highest_resolution` varchar(255) NOT NULL default '',
  `start_time` varchar(255) NULL,
  `stream_server_url` varchar(255) NULL,
  `stream_key` varchar(255) NULL,
  `status` smallint(6) NOT NULL default '0',
  `product_sku` varchar(255) NULL,
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`live_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$installer->endSetup(); 
