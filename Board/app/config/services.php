<?php

use Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\View,
    Phalcon\Mvc\Url as UrlResolver,
    Phalcon\Mvc\View\Engine\Volt as VoltEngine,
    Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter,
    Phalcon\Session\Adapter\Files as SessionAdapter;

// The FactoryDefault Dependency Injector automatically registers the
// right services providing a full-stack framework
$di = new \Phalcon\DI\FactoryDefault();

/**
 * We register the events manager
 */
$di->set('dispatcher', function() use ($di) {

    $eventsManager = $di->getShared('eventsManager');

    $security = new Security($di);

    /**
     * We listen for events in the dispatcher using the Security plugin
     */
    $eventsManager->attach('dispatch', $security);

    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function() use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function() use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function($view, $di) use ($config) {

    $volt = new VoltEngine($view, $di);

    $volt->setOptions(array(
        'compiledPath' => $config->application->cacheDir,
        'compiledExtension' => '.compiled',
        'compiledSeparator' => '_',
        'compileAlways' => true
    ));

    $compiler = $volt->getCompiler();

    $compiler->addFilter('minustospace', function($resolvedArgs, $exprArgs) {
        return "str_replace('-', ' ', '" . $resolvedArgs . "')";
    }
    );

    return $volt;
},
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('localiza', function() use ($config) {
    return new Twm\Db\Adapter\Pdo\Mssql(array(
        'host' => $config->localiza->host,
        'username' => $config->localiza->username,
        'password' => $config->localiza->password,
        'dbname' => $config->localiza->dbname,
        'pdoType' => $config->localiza->pdoType,
        'dialectClass' => $config->localiza->dialectClass
    ));
});

$di->set('fisico', function() use ($config) {
    return new Twm\Db\Adapter\Pdo\Mssql(array(
        'host' => $config->fisico->host,
        'username' => $config->fisico->username,
        'password' => $config->fisico->password,
        'dbname' => $config->fisico->dbname,
        'pdoType' => $config->fisico->pdoType,
        'dialectClass' => $config->fisico->dialectClass
    ));
});

$di->set('juridico', function() use ($config) {
    return new Twm\Db\Adapter\Pdo\Mssql(array(
        'host' => $config->juridico->host,
        'username' => $config->juridico->username,
        'password' => $config->juridico->password,
        'dbname' => $config->juridico->dbname,
        'pdoType' => $config->juridico->pdoType,
        'dialectClass' => $config->juridico->dialectClass
    ));
});
/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function() {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});



/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function() {
    return new Phalcon\Flash\Session(array(
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
});

/**
 * Register router for adding params
 */
$di->set('router', function () {
    $router = new \Phalcon\Mvc\Router();
    $router->add(
            "/Localiza/Board/products/status/:params", array(
        "controller" => "products",
        "action" => "status",
        "params" => 2
            )
    );
    $router->add(
            "/Localiza/Board/users/status/:params", array(
        "controller" => "users",
        "action" => "status",
        "params" => 2
            )
    );
    $router->add(
            "/Localiza/Board/clients/products/:params", array(
        "controller" => "clients",
        "action" => "products",
        "params" => 1
            )
    );
    return $router;
});

