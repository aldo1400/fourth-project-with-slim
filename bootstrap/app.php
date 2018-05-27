<?php 

session_start();

require __DIR__.'/../vendor/autoload.php';

// $user=new \App\Models\User;
// var_dump($user);
// die();

$app=new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
          'driver' => 'mysql',
          'host' => 'localhost',
          'database' => 'codecourse',
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => ''
        ]
      ]
]);


$container=$app->getContainer();

$capsule=new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db']=function($container) use ($capsule){
    return $capsule;
};


$container['view']=function($container){

    $view=new \Slim\Views\Twig(__DIR__.'/../resources/views',[
        'cache'=>false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['validator']=function($container){
    return new App\Validation\Validator;
};


$container['HomeController']=function($container){
    return new App\Controllers\HomeController($container);
};

$container['AuthController']=function($container){
    return new App\Controllers\Auth\AuthController($container);
};

$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

require __DIR__.'/../app/routes.php';
