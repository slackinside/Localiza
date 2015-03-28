<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Independent configuration
require_once  'medoo.php';

$boardLVM = new medoo([
	// required
	'database_type' => 'mssql',
	'database_name' => 'board_LVM',
	'server' => 'localhost',
	'username' => 'DEVPUB',
	'password' => 'azix@2015',
 
	// optional
	'port' => 1433,
	'charset' => 'utf8',
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);

$repConsultaPf = new medoo([
	// required
	'database_type' => 'mssql',
	'database_name' => 'rep-consulta_pf',
	'server' => 'CENIC',
	'username' => 'DEV',
	'password' => 'az2013@@!!',
 
	// optional
	'port' => 1433,
	'charset' => 'utf8',
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);

$repConsultaPj = new medoo([
	// required
	'database_type' => 'mssql',
	'database_name' => 'rep-consulta_pj',
	'server' => 'CENIC',
	'username' => 'DEV',
	'password' => 'az2013@@!!',
 
	// optional
	'port' => 1433,
	'charset' => 'utf8',
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);
 
