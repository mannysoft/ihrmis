<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// https://gist.github.com/mannysoft/7594721
// https://gist.github.com/jkrehm/7375527
class View1 {

	public function __construct()
	{
		parent::__construct();
	}
	
	public static function make($view, array $parameters = array())
    {
        $ci2 =& get_instance();
        $ci2->config->load('blade', true);

        // Get paths from configuration
        $viewsPaths = $ci2->config->item('views_paths', 'blade');
        $cachePath = $ci2->config->item('cache_path', 'blade');
 
        // Create the file system objects
        $fileSystem = new Illuminate\Filesystem\Filesystem();
        $fileFinder = new Illuminate\View\FileViewFinder($fileSystem, $viewsPaths);
 
        // Create the Blade engine and register it
        $bladeEngine = new Illuminate\View\Engines\CompilerEngine(
            new Illuminate\View\Compilers\BladeCompiler($fileSystem, $cachePath)
        );
 
        $engineResolver = new Illuminate\View\Engines\EngineResolver();
        $engineResolver->register('blade', function() use ($bladeEngine) {
            return $bladeEngine;
        });
 
        // Create the environment object
        $environment = new Illuminate\View\Environment(
            $engineResolver,
            $fileFinder,
            new Illuminate\Events\Dispatcher()
        );
 
        // Create the view
		// Orig is return I change it to echo
        echo new Illuminate\View\View(
            $environment,
            $bladeEngine,
            $view,
            $fileFinder->find($view),
            $parameters
        );
		
    }
	
	public static function get($field, $default = '')
	{
		
	}
	
}