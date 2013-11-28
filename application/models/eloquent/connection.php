<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI = & get_instance();

$config = $CI->db; // Get the DB object
		
$pdo = new PDO('mysql:host='.$config->hostname.';dbname='.$config->database, $config->username, $config->password);

$drivers = array(
		'mysql' => '\Illuminate\Database\MySqlConnection',
		'pgsql' => '\Illuminate\Database\PostgresConnection',
		'sqlite' => '\Illuminate\Database\SQLiteConnection',
	);
	
$conn = new $drivers['mysql']($pdo, $config->database, $config->dbprefix);		


$resolver = new Illuminate\Database\ConnectionResolver;
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');


\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);

//return 0;

// We can also use this one
//https://github.com/Jonhoo/laravel-former/blob/33f507363e6d19e80296be529f2eb84cd22199f3/tests/bootstrap.php

$container = new Illuminate\Container\Container;

//var_dump($container);

// This is the directory to your app, which is needed
// for locale and other packages. For example, you
// will need to make a folder relative to this folder
// for lang, i.e. __DIR__.'/lang'
$container['path'] = __DIR__;
//$container['path'] = __DIR__.'/lang';
//echo $container['path'];
// You could also resolve the configuration package if
// neneded, or just cheat here :P
$container['config'] = array(
    'app.locale'          => 'en',
    'app.fallback_locale' => 'en',

    'database.default' => 'mysql',
	'database.fetch' => PDO::FETCH_CLASS,
    'database.connections' => array(

        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => __DIR__.'/../database/production.sqlite',
            'prefix'   => '',
        ),

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => $config->hostname,
            'database'  => $config->database,
            'username'  => $config->username,
            'password'  => $config->password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => $config->dbprefix,
        ),

        'pgsql' => array(
            'driver'   => 'pgsql',
            'host'     => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => '',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ),

        'sqlsrv' => array(
            'driver'   => 'sqlsrv',
            'host'     => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => '',
            'prefix'   => '',
        ),

    ),
	
	'app.aliases' => array(

		'View'            => 'Illuminate\Support\Facades\View',
		'Paginator'       => 'Illuminate\Support\Facades\Paginator',
		
		),
);

// Array of providers
$providers = array(
    'Illuminate\Events\EventServiceProvider',
    'Illuminate\Filesystem\FilesystemServiceProvider',
    'Illuminate\Database\DatabaseServiceProvider',
    'Illuminate\Translation\TranslationServiceProvider',
    'Illuminate\Validation\ValidationServiceProvider',
	'Illuminate\Pagination\PaginationServiceProvider',
	//'Illuminate\Session\SessionServiceProvider',
	
	
	//'Illuminate\View\ViewServiceProvider',
);

// Register all providers
$registered = array();
foreach ($providers as $provider)
{
    $instance = new $provider($container);
    $instance->register();
    $registered[] = $instance;
}

// Then boot them
foreach ($registered as $instance)
{
    $instance->boot();
}

// Create our abstract facade
abstract class Facade {

    protected static $key;

    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string  $method
     * @param  array   $args
     * @return mixed
	 */
     
    public static function __callStatic($method, $args)
    {
        //$instance = static::$container[static::$key];
		$instance = static::$container[static::$key];

        switch (count($args))
        {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

}

// Set the container on our facade class
Facade::setContainer($container);

// And our static classes
//class Cache extends Facade { protected static $key = 'cache'; }
class DB extends Facade { protected static $key = 'db'; }
class Lang extends Facade { protected static $key = 'translator'; }
class Validator extends Facade { protected static $key = 'validator'; }
class Paginator extends Facade { protected static $key = 'paginator'; }

//class View extends Facade { protected static $key = 'view'; }

use Illuminate\Database\Eloquent\Model as Eloquent;

class BaseModel extends Eloquent{
	
	public $errors;	
	
	public static function boot()
	{
		parent::boot();
		
		static::saving(function($model)
		{
			//return $post->validate();	
			if ( ! $model->force) return $model->validate();
		});
	}
	
	public function validate()
	{
		$rules = self::processRules(static::$rules);
		
		$messages = static::$messages;
		
		$validation = Validator::make($this->attributes, $rules, $messages);
		
		if($validation->passes()) return true;
		
		//$this->errors = $validation->messages();
		$this->errors = $validation->messages()->all();
		
		return false;
	}
	
	/**
	 * Process validation rules.
	 *
	 * @param  array  $rules
	 * @return array  $rules
	 */
	protected function processRules($rules)
	{
		$id = $this->getKey();
		
		array_walk($rules, function(&$item) use ($id)
		{
			// Replace placeholders
			$item = stripos($item, ':id:') !== false ? str_ireplace(':id:', $id, $item) : $item;
		});
		
		if($id != NULL)
		{
			if (array_key_exists('password', $rules)) {
				unset($rules['password']);
			}
		}
		
		return $rules;
	}
}

?>