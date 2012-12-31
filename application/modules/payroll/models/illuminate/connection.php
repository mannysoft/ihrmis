<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI = & get_instance();

$config = $CI->db; // Get the DB object

// https://gist.github.com/4417395

$resolver = new Illuminate\Database\ConnectionResolver;
$resolver->setDefaultConnection('default');
$factory = new Illuminate\Database\Connectors\ConnectionFactory;

$connection = $factory->make(array(
	'host'     	=> $config->hostname,
	'database' 	=> $config->database,
	'username' 	=> $config->username,
	'password' 	=> $config->password,
	'collation' => $config->dbcollat,
	'driver'   	=> 'mysql',
	'prefix'   	=> $config->dbprefix,
));

$resolver->addConnection('default', $connection);
 
Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);