<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'user_database',
        'password' => 'password_database',
        'database' => 'nama_database',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'cachedir' => '',
        'charSet'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'saveQueries' => true,
    ];

    public $tests = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'user_database',
        'password' => 'password_database',
        'database' => 'nama_database_test',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'cacheOn'  => false,
        'cachedir' => '',
        'charSet'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'saveQueries' => true,
    ];
}