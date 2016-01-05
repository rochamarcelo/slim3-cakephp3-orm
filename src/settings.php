<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        'datasources' => [
            'default' => [
                'className' => 'Cake\Database\Connection',
                'driver' => 'Cake\Database\Driver\Mysql',
                'persistent' => false,
                'host' => '127.0.0.1',
                'username' => 'root',
                'password' => '123456',
                'database' => 'slim_cake3_database',
                'encoding' => 'utf8',
                'timezone' => 'UTC',
                /*
                * Set identifier quoting to true if you are using reserved words or
                * special characters in your table or column names. Enabling this
                * setting will result in queries built using the Query Builder having
                * identifiers quoted when creating SQL. It should be noted that this
                * decreases performance because each query needs to be traversed and
                * manipulated before being executed.
                */
                'quoteIdentifiers' => false,
            ]
        ]
    ],
];
