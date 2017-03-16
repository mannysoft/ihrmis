<?php

namespace Ihrmis\Tax\Deductions;
use Ihrmis\Tax\Models\PhilHealth as PhilHealthModel;

class PhilHealth {

	public $tables = null;
	protected $philHealth;

	function __construct(PhilHealthModel $philHealth)
    {
		$this->philHealth = $philHealth;
    }

}