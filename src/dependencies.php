<?php
use Cake\Datasource\ConnectionManager;

// DIC configuration
$container = $app->getContainer();

$container['errodrHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $code = 500;
        $errorCode = $exception->getCode();
        if ($errorCode >= 400 && $errorCode < 506) {
            $code = $errorCode;
        }
        return $c['response']->withStatus($code);
    };
};

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['AnimesTable'] = function() {
    return Cake\ORM\TableRegistry::get('Animes', [
        'className' => 'App\Model\Table\AnimesTable'
    ]);
};

ConnectionManager::config($container['settings']['datasources']);