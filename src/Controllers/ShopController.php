<?php 
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;

use \Carbon\Carbon;

class ShopController extends BaseController{

    public function __construct(ContainerInterface $container){
        parent::__construct($container);
    }

    public function getIndex(Request $request, Response $response, $args) {

        return view($response,'site.tienda', null);
    }

    public function getProduct(Request $request, Response $response, $args) {

        //$product = Product::where('id', $args['id'])->first();

        return view($response,'site.tienda', null);
    }

}