<?php
use Slim\Factory\AppFactory;

use Jenssegers\Blade\Blade;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Response;
use App\Exceptions\CustomErrorRenderer;
error_reporting(E_ERROR | E_PARSE);

if (session_status() == PHP_SESSION_NONE) {session_start();}

setlocale(LC_ALL, Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']));
setlocale(LC_MONETARY, 'es_AR.UTF-8');
setlocale(LC_TIME,"es_ES.UTF-8");

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/Functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../../");
$dotenv->safeLoad();

$tmpContainer = new \DI\Container();
AppFactory::setContainer($tmpContainer);
$app = AppFactory::create();
// $app->setBasePath("/recibos");
$container = $app->getContainer();

require __DIR__ . '/Config.php';

$container->set('upload_directory', __DIR__ . '/../../html/images');

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('db_illuminate'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

setlocale(LC_ALL, "ar_AR");

require __DIR__ . '/Routes.php';
require __DIR__ . '/Dependencies.php';

// manejar error -- Descomentar en prod y cambiar a false

$errorMiddleware = $app->addErrorMiddleware(true,true,false);
// $errorMiddleware = $app->addErrorMiddleware(false,true,false);
// $errorHandler = $errorMiddleware->getDefaultErrorHandler();
// $errorHandler->registerErrorRenderer('text/html', CustomErrorRenderer::class);


$app->run();