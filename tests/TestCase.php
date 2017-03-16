<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	public function setUp()
	{
	    parent::setUp();

	    config(['app.url' => 'http://127.0.0.1:8888']);
	}

    use CreatesApplication;
}
