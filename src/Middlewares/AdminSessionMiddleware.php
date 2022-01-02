<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class AdminSessionMiddleware{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $logged = false;
        
        if(isset($_SESSION['user']) && $_SESSION['user']>0){
            $logged = true;
        }

        if(isset($_SESSION['adm_user']) && $_SESSION['adm_user']>0){
            $logged = true;
        }

        if(!$logged){
            if($_SERVER['REQUEST_URI'] != siteUrl('/admin/login')) {
                return $response->withHeader('Location', siteUrl('/admin/login'))->withStatus(302);
            }else{
                return $response;
            }
        }else{
            if($_SERVER['REQUEST_URI'] != siteUrl('/admin/login')) {
                return $response;
            }else{
                return $response->withHeader('Location', siteUrl('/admin'))->withStatus(302);
            }
        }
    }
}