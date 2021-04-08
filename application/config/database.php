<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'demo',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => TRUE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
// $db['dbPIC'] = array(
// 	'dsn'	=> '',
// 	'hostname' => '192.168.1.10',
// 	'username' => 'sapayroll',
// 	'password' => 'mispwdpayroll',
// 	'database' => 'P1PIC',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => TRUE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => TRUE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );
// $db['dbQAD2'] = array(
// 	'dsn'	=> '',
// 	'hostname' => '192.168.1.10',
// 	'username' => 'sapayroll',
// 	'password' => 'mispwdpayroll',
// 	'database' => 'P1QAD',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => TRUE,
// 	'db_debug' => FALSE,
// 	'cache_on' => TRUE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );
// $db['dbEForm'] = array(
// 	'dsn'	=> '',
// 	'hostname' => '192.168.3.8',
// 	'username' => 'tamu',
// 	'password' => 'tamu',
// 	'database' => 'dbqad', //qad_db
// 	'dbdriver' => 'postgre',
// 	'dbprefix' => '',
// 	'pconnect' => TRUE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => TRUE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );
// $db['dbMIS'] = array(
// 	'dsn'	=> '',
// 	'hostname' => '192.168.3.2',
// 	'username' => 'mypsg',
// 	'password' => 'psg8989',
// 	'database' => 'MIS',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => TRUE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => TRUE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );
// $db['dbWTP'] = array(
// 	'dsn'	=> '',
// 	//'hostname' => '192.168.3.2',
// 	//'username' => 'mypsg',
// 	//'password' => 'psg8989',

// 	 'hostname' => '192.168.1.10',
// 	 'username' => 'sapayroll',
// 	 'password' => 'mispwdpayroll',
	
// 	'database' => 'P1WTP',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => TRUE,
// 	'db_debug' => FALSE,
// 	'cache_on' => TRUE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );
