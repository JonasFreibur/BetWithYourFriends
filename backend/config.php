<?php

// dev

return array(
    'host' => 'mysql:host=127.0.0.1',
    'username' => 'root',
    'password' => '',
    'dbh' => 0,
    'db_name' => 'bet',
    'db_port' => 3306,
    'connection_description' => [],
    'options' => [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION],
    'relative_path' => __DIR__ . '../',
    'install_prefix' => 'bet/awa-g3-bet/backend',
);

// prod
// TODO : Hide password
