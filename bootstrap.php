<?php
/**
 * The CodeIgniter Handbook - Volume Three - Unit Testing
 * https://efendibooks.com/books/codeigniter-handbook/vol-3
 *
 * bootstrap.php - CodeIgniter bootstrap mechanism.
 *
 * Copyright (c) 2012 Jamie Rumbelow <http://jamierumbelow.net>
 */

$oldArgv = $_SERVER['argv'];
$_SERVER['argv'] = array( '', 'test_bootstrap' );

require_once 'public/index.php';

$_SERVER['argv'] = $oldArgv;