<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$CI = & get_instance();

$config = $CI->db; // Get the DB object

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $config->hostname,
    'database'  => $config->database,
    'username'  => $config->username,
    'password'  => $config->password,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => $config->dbprefix,
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Set the cache manager instance used by connections... (optional)
//$capsule->setCacheManager();

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
 
class Test extends Illuminate\Database\Eloquent\Model {

	//public $timestamps = false;
	
	protected $table = "users"; 
	
	// --------------------------------------------------------------------
}