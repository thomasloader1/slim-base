<?php 
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;

use \Carbon\Carbon;

class HomeController extends BaseController{

    public function __construct(ContainerInterface $container){
        parent::__construct($container);
    }

    public function getIndex(Request $request, Response $response, $args) {

        return view($response,'site.index', null);
    }

    public function getTienda(Request $request, Response $response, $args) {
        
        return view($response,'site.tienda', null);
    }
    
    public function getCursos(Request $request, Response $response, $args) {
        
        return view($response,'site.cursos', null);
    }
}