<?php
/**
 * The CodeIgniter Handbook - Volume Three - Unit Testing
 * https://efendibooks.com/books/codeigniter-handbook/vol-3
 *
 * hooks/phpunit.php - A silly CodeIgniter fix
 *
 * Copyright (c) 2012 Jamie Rumbelow <http://jamierumbelow.net>
 */

class PHPUnit_CodeIgniter_Hook
{
	public function pre_system()
	{
		$GLOBALS['CFG'] =& load_class('Config', 'core');
		$GLOBALS['BM'] =& load_class('Benchmark', 'core');
	}
}