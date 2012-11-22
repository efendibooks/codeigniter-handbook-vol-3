<?php

class PHPUnit_CodeIgniter_Hook
{
	public function pre_system()
	{
		$GLOBALS['CFG'] =& load_class('Config', 'core');
		$GLOBALS['BM'] =& load_class('Benchmark', 'core');
	}
}