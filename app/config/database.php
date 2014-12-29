<?php

return array(

	'fetch' => PDO::FETCH_CLASS,
	'default' => 'mysql',
	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => getenv('DB_HOST'),
			'database'  => getenv('DB_SCHEMA'),
			'username'  => getenv('DB_USERNAME'),
			'password'  => getenv('DB_PASSWORD'),
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	),
	'migrations' => 'migrations',

);
