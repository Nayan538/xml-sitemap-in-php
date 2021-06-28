<?php

$GLOBALS['DB_CONFIG'] = [
   'mysql'	=> [
      'driver'		=> 'mysql',
      'url'			=> '',
      'host'		=> 'localhost',
      'port'		=> '3306',
      'database'	=> 'test',
      'username'	=> 'root',
      'password'	=> '',
      'charset'	=> 'utf8mb4',
      'collation'	=> 'utf8mb4_unicode_ci',
      'prefix'		=> ''
   ],
   'sqlite'	=> [
      'driver'		=> 'sqlite',
      'url'			=> __DIR__ . '/',
      'database'	=> '',
      'prefix'		=> '',
      'fk_const'	=> ''
   ],
   'pgsql'	=> [
      'driver'		=> 'pgsql',
      'url'			=> '',
      'host'		=> 'localhost',
      'port'		=> '5432',
      'database'	=> '',
      'username'	=> 'root',
      'password'	=> '',
      'charset'	=> 'utf8mb4',
      'collation'	=> '',
      'prefix'		=> ''
   ],
];


define('DB', $GLOBALS['DB_CONFIG']['mysql']);
define('APP', str_replace("\\", "/", str_replace('app', '', __DIR__)));