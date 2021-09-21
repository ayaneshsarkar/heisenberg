<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require_once __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;
    use App\Core\Application;
    use App\Controllers\HomeController;

    $env = Dotenv::createImmutable(dirname(__DIR__));
    $env->load();

    $app = new Application(dirname($_SERVER['DOCUMENT_ROOT']));
    $route = $app->route;

    
    // Home
    $route->get('/', [HomeController::class, 'home']);
    $app->run();