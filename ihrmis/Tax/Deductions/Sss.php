<?php

namespace Ihrmis\Tax\Deductions;
use Ihrmis\Tax\Models\Sss as SssModel;

class Sss {

	public $tables = null;
    protected $sss;

	function __construct(SssModel $sss)
    {
		$this->sss = $sss;
    }

}