<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$active_record = TRUE;//ci version 2.x

$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'bms_sys',
    'password' => '^btmk4xb9L#J^1Bs',
    'database' => 'sell_update_v2',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'development'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'autoinit' => TRUE,//ci version 2.x
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
