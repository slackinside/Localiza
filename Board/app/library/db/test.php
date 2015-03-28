<?php

// Creates the autoloader
$loader = new \Phalcon\Loader();

$loader->registerDirs(
	array('models/')
);

//Register some namespaces
$loader->registerNamespaces(
		array(
			"Twm\Db\Adapter\Pdo"    => "adapter/",
			"Twm\Db\Dialect"    => "dialect/"
			)
		);

// register autoloader
$loader->register();

echo '<h1>connect</h1>';
$mc = array(
		'host'		=> 'NE-R012-108CN',
		'username'	=> 'DEV',
		'password'	=> 'az2013@@!!',
		'dbname'	=> 'localiza',
		'dialectClass'	=> '\Twm\Db\Dialect\Mssql'	

	);
$db = new \Twm\Db\Adapter\Pdo\Mssql($mc); 
if (!$db->connect()){
	$db->close();
	die('connection failed');
}

//testModel($db);
testQueryBinding($db);

function testModel($db){
	$product = new Products();
}

function testQueryBinding($db){
	echo '<h1>execute query</h1>';
	$sqlStatement = "select * from dbo.Products ";
	//$bindParams = array(':aaa'=>'1',':bbb'=>'2');

	var_dump($db->query($sqlStatement));
}

function testDescribeColumns(){
	var_dump($db->describeColumns('Products_nome'));
}