<?php
  require_once __DIR__.'/../vendor/autoload.php';

  $app = new Silex\Application;

  $app['debug'] = true;

  $app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__.'/../views'
  ]);

  $app->register(new Silex\Provider\DoctrineServiceProvider, [
    'db.options' => [
      'driver' => 'pdo_mysql',
      'host' => 'localhost',
      'dbname' => 'fresher',
      "username" => 'root',
      'password' => '',
      'charset' => 'utf8'
    ]
  ]);

  $app->register(new AI\Providers\UploadcareProvider);

  $app->get('/', function() use ($app) {

    // var_dump($app['uploadcare']);
    // die();

    $images = $app['db']->prepare("SELECT * FROM images");
    $images->execute();

    $images = $images->fetchAll(PDO::FETCH_CLASS, \AI\Models\Image::class);
    // var_dump($images);
    return $app['twig']->render('home.twig');
  });

  $app->run();

?>
